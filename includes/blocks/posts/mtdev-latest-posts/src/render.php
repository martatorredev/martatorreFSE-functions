<?php

$args = array(
  'post_type'        => 'post',
  'post_status'      => 'publish',
  'posts_per_page'   => $attributes['postsToShow'],
  'suppress_filters' => false,
);

// Set search var
$search = mtdev_get_var( 's-search', '' );
if ( $search ) {
  $args['s'] = $search;
}

// Set page var
$paged = mtdev_get_var( 'paged', false );
$paged = $paged
  ? $paged
  : get_query_var( 'paged' );

if ( $paged ) {
  $args['paged'] = $paged ;
}

// Set category var
$category = mtdev_get_var( 's-category', -1 );
$category = array_key_exists( 'category', $attributes )
  ? $attributes['category']
  : $category;
$category = intval( $category );

if ( $category > 0 ) {
  $args['tax_query'] = array(
    array(
      'taxonomy' => 'category',
      'field'    => 'term_id',
      'terms'    => $category,
    )
  );
  $args['meta_query'] = array(
    array(
      'key'     => 'rank_math_primary_category',
      'value'   => $category,
      'compare' => 'LIKE'
    )
  );
}

$order = mtdev_get_var( 's-order', false );
$order = $order
  ? $order
  : $attributes['order'];

if ( $order ) {
  $args['order'] = $order;
}

$is_from_request = array_key_exists( 'isFromRequest', $attributes );

$use_global_query = isset( $attributes['inheritQuery'] ) && $attributes['inheritQuery'];

if ( $use_global_query ) {
  global $wp_query;
  $query = clone $wp_query;
} else {
  $query = new WP_Query( $args );
}

// Send some data to frontend
$frontend_attrributes = array(
  'paged'                => $query->query_vars['paged'],
  's-order'              => $query->query_vars['order'],
  'hasPagination'        => $attributes['hasPagination'],
  'postsToShow'          => $query->query_vars['posts_per_page'],
  'orderBy'              => $attributes['orderBy'],
  'isFromRequest'        => true,
);

if ( ! empty( $query->query_vars['tax_query'] ) ) {
  $frontend_attrributes['s-category'] = $query->query_vars['tax_query'][0]['terms'];
} else if ( is_category()) {
  $frontend_attrributes['s-category'] = get_query_var( 'cat' );
}


// Add filter controls
if ( ! $is_from_request && $attributes['hasFilters'] ) {
  $show_category_filter = true;

  if ( isset( $attributes['category'] ) ) {
    $show_category_filter = intval( $attributes['category'] ) === -1;
  }

  if ( is_category() ) {
    $show_category_filter = false;
  }

  $action = get_permalink( get_the_ID() );
  if ( is_category() ) $action = '#';

  ?>
  <div class="latest-posts-grid-filters">
    <form class="latest-posts-grid-filters__form" action="<?php echo $action ?>" method="GET">
      <!-- Category item -->
      <?php
        if ( $show_category_filter ) {
          ?>
          <div class="latest-posts-grid-filters__form-item">
            <label class="latest-posts-grid-filters__form-label" for="s-category">Categoría</label>
            <select class="latest-posts-grid-filters__form-input" name="s-category" id="s-category">
              <option value="-1">Todas</option>
              <?php
                $categories = get_categories();
                foreach ( $categories as $category_item ) {
                  if ( $category_item->count < 1 ) continue;
                  $selected = $category_item->term_id == $category ? 'selected' : '';
                  echo '<option value="' . esc_attr( $category_item->term_id ) . '" ' . $selected . '>' . esc_html( $category_item->name ) . '</option>';
                }
              ?>
            </select>
          </div>
          <?php
        }
      ?>

      <!-- Sorting item -->
      <div class="latest-posts-grid-filters__form-item">
        <label class="latest-posts-grid-filters__form-label" for="s-order">Ordenar entradas por</label>
        <select class="latest-posts-grid-filters__form-input" name="s-order" id="s-order">
          <option value="DESC" <?php echo $order === 'DESC' ? 'selected' : ''; ?>>Mas nuevas primero</option>
          <option value="ASC" <?php echo $order === 'ASC' ? 'selected' : ''; ?>>Mas antiguas primero</option>
        </select>
      </div>

      <!-- Search item -->
      <div class="latest-posts-grid-filters__form-item wp-block-search__button-inside wp-block-search__icon-button wp-block-search">
        <label class="latest-posts-grid-filters__form-label wp-block-search__label" for="s-search">Buscador</label>
        <div class="wp-block-search__inside-wrapper">
          <input class="latest-posts-grid-filters__form-input wp-block-search__input" type="search" name="s-search" id="s-search" value="<?php echo esc_attr( $search ); ?>" placeholder="Buscar entradas">
          <button aria-label="Buscar" class="wp-block-search__button has-icon wp-element-button" type="submit">
            <svg class="search-icon" viewBox="0 0 24 24" width="24" height="24">
              <path d="M13 5c-3.3 0-6 2.7-6 6 0 1.4.5 2.7 1.3 3.7l-3.8 3.8 1.1 1.1 3.8-3.8c1 .8 2.3 1.3 3.7 1.3 3.3 0 6-2.7 6-6S16.3 5 13 5zm0 10.5c-2.5 0-4.5-2-4.5-4.5s2-4.5 4.5-4.5 4.5 2 4.5 4.5-2 4.5-4.5 4.5z"></path>
            </svg>
          </button>
        </div>
      </div>
    </form>
  </div>
  <?php
}

if ( ! $is_from_request ) {
  echo '<section class="latest-posts-grid" data-attributes="' . esc_html( json_encode( $frontend_attrributes ) ) . '">';
}
if ( $query->have_posts() ) {
  while ( $query->have_posts() ) {
    $query->the_post();
    ?>
    <article class="latest-posts-grid-item">
      <a class="latest-posts-grid-item__link" href="<?php the_permalink(); ?>">Ir a la entrada</a>

      <div class="latest-posts-grid-item__header">
        <div class="latest-posts-grid-item__thumbnail">
          <?php
            if ( has_post_thumbnail() ) {
              echo get_the_post_thumbnail();
            } else {
              ?>
              <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/placeholder.png' ); ?>" alt="Placeholder">
              <?php
            }
          ?>
        </div>
      </div>

      <div class="latest-posts-grid-item__info">
        <?php
        $primary_category_id = get_post_meta( '$post_id', 'rank_math_primary_category', true );
        $post_category = $primary_category_id
          ? get_term_by('id', $primary_category_id, 'category')
          : get_the_category();

        if ( is_array ( $post_category ) && ! empty( $post_category ) ) $post_category = $post_category[0];

        if ( $post_category ) {
          ?>
          <ul class="latest-posts-grid-item__categories">
            <li class="latest-posts-grid-item__category">
              <a class="latest-posts-grid-item__category-link" href="<?php
                echo esc_url( get_category_link( $post_category->term_id ) );
              ?>"><?php echo esc_html( $post_category->name ); ?></a>
            </li>
          </ul>
          <?php
        }
        ?>

        <time class="latest-posts-grid-item__date"><?php the_date( 'd \d\e F \d\e Y')?></time>

        <h3 class="latest-posts-grid-item__title">
          <a class="latest-posts-grid-item__title-link" href="<?php the_permalink(); ?>">
            <?php the_title(); ?>
          </a>
        </h3>
      </div>
    </article>
    <?php
  }
} else {
  ?>
  <div class="latest-posts-grid__no-results">
    <p class="latest-posts-grid__no-results-text">No se encontraron resultados <?php
      if ( $search ) {
        echo 'para la búsqueda <strong>' . esc_html( $search ) . '</strong>';
      }
    ?></p>
  </div>
  <?php
}

if ( $attributes['hasPagination'] ) {
  $base = isset( $attributes['base'] )
    ? $attributes['base'] . 'page/%_%'
    : str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) );

  $links = paginate_links( array(
    // 'base'         =>'?s-page=%_%',
    'base'         => $base,
    'format'       => '%#%',
    'total'        => $query->max_num_pages,
    'current'      => max( 1, $query->query_vars['paged'] ),
    'show_all'     => false,
    'type'         => 'list',
    'end_size'     => 1,
    'mid_size'     => 1,
    'add_args'     => array (
      's-search'   => $search,
      's-category' => $category
    ),
    'add_fragment' => '',
    'prev_next'    => true,
    'prev_text'    => '<',
    'next_text'    => '>',
  ) );

  echo _navigation_markup( $links );
}

if ( ! $is_from_request ) echo '</section>';

wp_reset_postdata();
