<?php

$args = array(
  'post_status'      => 'publish',
  'post_type'        => 'mis-proyectos-web',
  'posts_per_page'   => $attributes['numberOfItems'],
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
      'taxonomy' => 'mis_proyectos_web_category',
      'field'    => 'term_id',
      'terms'    => $category,
    )
  );
  // $args['meta_query'] = array(
  //   array(
  //     'key'     => 'rank_math_primary_mis_proyectos_web_category',
  //     'value'   => $category,
  //     'compare' => 'LIKE'
  //   )
  // );
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
  'paged'         => $query->query_vars['paged'],
  's-order'       => $query->query_vars['order'],
  'hasPagination' => $attributes['hasPagination'],
  'numberOfItems' => $query->query_vars['posts_per_page'],
  'orderBy'       => $attributes['orderBy'],
  'isFromRequest' => true,
);

if ( ! empty( $query->query_vars['tax_query'] ) ) {
  $frontend_attrributes['s-category'] = $query->query_vars['tax_query'][0]['terms'];
} else if ( is_category() ) {
  $frontend_attrributes['s-category'] = get_query_var( 'cat' );
} else if ( is_tax() ) {
  $frontend_attrributes['s-category'] = get_queried_object_id();
}

$latest_posts = $query;

// Add filter controls
if ( ! $is_from_request && $attributes['hasFilters'] ) {
  $show_category_filter = true;

  if ( isset( $attributes['category'] ) ) {
    $show_category_filter = intval( $attributes['category'] ) === -1;
  }

  if ( is_category() || is_tax()  ) {
    $show_category_filter = false;
  }

  $action = get_permalink( get_the_ID() );
  if ( is_category() || is_tax() ) $action = '#';

  ?>
  <div class="mtdev-projects-filters">
    <form class="mtdev-projects-filters__form" action="<?php echo $action ?>" method="GET">
      <!-- Category item -->
      <?php
        if ( $show_category_filter ) {
          ?>
          <div class="mtdev-projects-filters__form-item">
            <label class="mtdev-projects-filters__form-label" for="s-category">Categoría</label>
            <select class="mtdev-projects-filters__form-input" name="s-category" id="s-category">
              <option value="-1">Todas</option>
              <?php
                $categories = get_terms( 'mis_proyectos_web_category' );

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
      <div class="mtdev-projects-filters__form-item">
        <label class="mtdev-projects-filters__form-label" for="s-order">Ordenar proyectos por</label>
        <select class="mtdev-projects-filters__form-input" name="s-order" id="s-order">
          <option value="DESC" <?php echo $order === 'DESC' ? 'selected' : ''; ?>>Mas nuevas primero</option>
          <option value="ASC" <?php echo $order === 'ASC' ? 'selected' : ''; ?>>Mas antiguas primero</option>
        </select>
      </div>

      <!-- Search item -->
      <div class="mtdev-projects-filters__form-item wp-block-search__button-inside wp-block-search__icon-button wp-block-search">
        <label class="mtdev-projects-filters__form-label wp-block-search__label" for="s-search">Buscador</label>
        <div class="wp-block-search__inside-wrapper">
          <input class="mtdev-projects-filters__form-input wp-block-search__input" type="search" name="s-search" id="s-search" value="<?php echo esc_attr( $search ); ?>" placeholder="Buscar proyecto">
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
  echo '<section class="mtdev-projects" data-attributes="' . esc_html( json_encode( $frontend_attrributes ) ) . '">';
}
if ( $latest_posts->have_posts() ) {
  while ( $latest_posts->have_posts() ) {
    $latest_posts->the_post();
    ?>
    <article class="mtdev-projects-item">
      <a class="mtdev-projects-item__link" href="<?php the_permalink(); ?>">Ver proyecto</a>

      <div class="mtdev-projects-item__header">
        <div class="mtdev-projects-item__thumbnail">
          <?php
            the_post_thumbnail();
          ?>
        </div>
      </div>

      <div class="mtdev-projects-item__info">
        <?php
        $id = get_the_id();
        $primary_category_id = get_post_meta( $id, 'rank_math_primary_mis_proyectos_web_category', true );
        $post_category = get_term( $primary_category_id, 'mis_proyectos_web_category' );

        if ( !$post_category || is_wp_error( $post_category ) ) {
          $categories = get_the_terms( $id, 'mis_proyectos_web_category' );

          if ( ! empty( $categories ) ) {
            $post_category = $categories[0];
          }
        }

        if ( $post_category ) {
          ?>
          <ul class="mtdev-projects-item__categories">
            <li class="mtdev-projects-item__category">
              <a class="mtdev-projects-item__category-link" href="<?php
                echo esc_url( get_category_link( $post_category->term_id ) );
              ?>"><?php echo esc_html( $post_category->name ); ?></a>
            </li>
          </ul>
          <?php
        }

        ?>

        <h3 class="mtdev-projects-item__title">
          <?php the_title(); ?>
        </h3>

        <a class="mtdev-projects-item__button" href="<?php the_permalink(); ?>">
          Ver proyecto
        </a>
      </div>
    </article>
    <?php
  }
} else {
  ?>
  <div class="mtdev-projects__no-results">
    <p class="mtdev-projects__no-results-text">No se encontraron resultados <?php
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
