<?php

defined( 'ABSPATH' ) or exit;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Widget_Base;

class Elem_Portfolio_Carousel extends Widget_Base {

	public function get_title(): string {
		return 'Portfolio Carousel';
	}

	public function get_script_depends(): array {
		return [];
	}

	public function get_style_depends(): array {
		return [
			$this->_get_asset_handle(),
		];
	}

	protected function register_controls() {

		/*
		 * CONTENT
		 */
		$this->start_controls_section(
			'content_section',
			[
				'label' => 'Portfolio Items',
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'image',
			[
				'label'   => 'Image',
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_control(
			'category',
			[
				'label'       => 'Category',
				'type'        => Controls_Manager::TEXT,
				'default'     => 'Portfolio',
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'title',
			[
				'label'       => 'Title',
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => 'BlazeTrail: Pioneering the Path of Creativity',
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'button_text',
			[
				'label'   => 'Button Text',
				'type'    => Controls_Manager::TEXT,
				'default' => 'Read More',
			]
		);

		$repeater->add_control(
			'link',
			[
				'label'       => 'Link',
				'type'        => Controls_Manager::URL,
				'placeholder' => 'https://example.com',
				'default'     => [
					'url' => '#',
				],
			]
		);

		$this->add_control(
			'items',
			[
				'label'       => 'Portfolio Items',
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'category'    => 'Portfolio',
						'title'       => 'BlazeTrail: Pioneering the Path of Creativity',
						'button_text' => 'Read More',
					],
					[
						'category'    => 'Portfolio',
						'title'       => 'InnoVista: Bridging Ideas and Innovation',
						'button_text' => 'Read More',
					],
					[
						'category'    => 'Portfolio',
						'title'       => 'PixelPulse: Where Art Meets Functionality',
						'button_text' => 'Read More',
					],
					[
						'category'    => 'Portfolio',
						'title'       => 'Creative Horizons: Building Digital Experiences',
						'button_text' => 'Read More',
					],
					[
						'category'    => 'Portfolio',
						'title'       => 'Digital Landscapes: Designing New Possibilities',
						'button_text' => 'Read More',
					],
					[
						'category'    => 'Portfolio',
						'title'       => 'VisionCraft: Turning Ideas Into Reality',
						'button_text' => 'Read More',
					],
				],
				'title_field' => '{{{ title }}}',
			]
		);

		$this->end_controls_section();

		/*
		 * CAROUSEL
		 */
		$this->start_controls_section(
			'carousel_section',
			[
				'label' => 'Carousel',
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_responsive_control(
			'columns',
			[
				'label'           => 'Columns',
				'type'            => Controls_Manager::SELECT,
				'default'         => '3',
				'tablet_default'  => '2',
				'mobile_default'  => '1',
				'options'         => [
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
				],
				'selectors'       => [
					'{{WRAPPER}} .pcw-track' => '--pcw-columns: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'gap',
			[
				'label'      => 'Gap',
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'default'    => [
					'unit' => 'px',
					'size' => 14,
				],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 80,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .pcw-track' => '--pcw-gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label'        => 'Autoplay',
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => 'Yes',
				'label_off'    => 'No',
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		$this->add_control(
			'autoplay_speed',
			[
				'label'     => 'Autoplay Speed',
				'type'      => Controls_Manager::NUMBER,
				'default'   => 5000,
				'min'       => 1000,
				'step'      => 500,
				'condition' => [
					'autoplay' => 'yes',
				],
			]
		);

		$this->add_control(
			'show_arrows',
			[
				'label'        => 'Show Arrows',
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => 'Show',
				'label_off'    => 'Hide',
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'show_dots',
			[
				'label'        => 'Show Dots',
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => 'Show',
				'label_off'    => 'Hide',
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->end_controls_section();

		/*
		 * IMAGE
		 */
		$this->start_controls_section(
			'image_style',
			[
				'label' => 'Image',
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'image_height',
			[
				'label'      => 'Image Height',
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'vh' ],
				'default'    => [
					'unit' => 'px',
					'size' => 272,
				],
				'range'      => [
					'px' => [
						'min' => 100,
						'max' => 600,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .pcw-image' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'image_object_fit',
			[
				'label'     => 'Object Fit',
				'type'      => Controls_Manager::SELECT,
				'default'   => 'cover',
				'options'   => [
					'cover'   => 'Cover',
					'contain' => 'Contain',
					'fill'    => 'Fill',
				],
				'selectors' => [
					'{{WRAPPER}} .pcw-image img' => 'object-fit: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'image_radius',
			[
				'label'      => 'Border Radius',
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default'    => [
					'top'    => 0,
					'right'  => 0,
					'bottom' => 0,
					'left'   => 0,
					'unit'   => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .pcw-image img' =>
						'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		/*
		 * CARD
		 */
		$this->start_controls_section(
			'card_style',
			[
				'label' => 'Card',
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'card_background',
			[
				'label'     => 'Background',
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .pcw-card' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'card_radius',
			[
				'label'      => 'Border Radius',
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .pcw-card' =>
						'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'card_shadow',
				'selector' => '{{WRAPPER}} .pcw-card',
			]
		);

		$this->end_controls_section();

		/*
		 * CATEGORY
		 */
		$this->start_controls_section(
			'category_style',
			[
				'label' => 'Category',
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'category_color',
			[
				'label'     => 'Color',
				'type'      => Controls_Manager::COLOR,
				'default'   => '#df8589',
				'selectors' => [
					'{{WRAPPER}} .pcw-category' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'category_typography',
				'selector' => '{{WRAPPER}} .pcw-category',
			]
		);

		$this->end_controls_section();

		/*
		 * TITLE
		 */
		$this->start_controls_section(
			'title_style',
			[
				'label' => 'Title',
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => 'Color',
				'type'      => Controls_Manager::COLOR,
				'default'   => '#111111',
				'selectors' => [
					'{{WRAPPER}} .pcw-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .pcw-title',
			]
		);

		$this->add_responsive_control(
			'title_min_height',
			[
				'label'      => 'Minimum Height',
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'default'    => [
					'unit' => 'px',
					'size' => 68,
				],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .pcw-title' => 'min-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		/*
		 * BUTTON
		 */
		$this->start_controls_section(
			'button_style',
			[
				'label' => 'Button',
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'button_color',
			[
				'label'     => 'Background',
				'type'      => Controls_Manager::COLOR,
				'default'   => '#df8589',
				'selectors' => [
					'{{WRAPPER}} .pcw-button' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_color',
			[
				'label'     => 'Hover Background',
				'type'      => Controls_Manager::COLOR,
				'default'   => '#d47479',
				'selectors' => [
					'{{WRAPPER}} .pcw-button:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label'     => 'Text Color',
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .pcw-button' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'button_typography',
				'selector' => '{{WRAPPER}} .pcw-button',
			]
		);

		$this->add_control(
			'button_radius',
			[
				'label'      => 'Border Radius',
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .pcw-button' =>
						'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		/*
		 * NAVIGATION
		 */
		$this->start_controls_section(
			'navigation_style',
			[
				'label' => 'Navigation',
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'arrow_background',
			[
				'label'     => 'Arrow Background',
				'type'      => Controls_Manager::COLOR,
				'default'   => '#df8589',
				'selectors' => [
					'{{WRAPPER}} .pcw-arrow' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'arrow_color',
			[
				'label'     => 'Arrow Color',
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .pcw-arrow' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'dot_color',
			[
				'label'     => 'Dot Color',
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ead0d1',
				'selectors' => [
					'{{WRAPPER}} .pcw-dot' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'dot_active_color',
			[
				'label'     => 'Active Dot Color',
				'type'      => Controls_Manager::COLOR,
				'default'   => '#df8589',
				'selectors' => [
					'{{WRAPPER}} .pcw-dot.is-active' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {

		$settings = $this->get_settings_for_display();
		$items    = ! empty( $settings['items'] ) ? $settings['items'] : [];

		if ( empty( $items ) ) {
			return;
		}

		$class = 'pcw-carousel';
		$uid   = uniqid( "$class-" );

		$show_arrows = 'yes' === ( $settings['show_arrows'] ?? '' );
		$show_dots   = 'yes' === ( $settings['show_dots'] ?? '' );
		$autoplay    = 'yes' === ( $settings['autoplay'] ?? '' );
		$speed       = ! empty( $settings['autoplay_speed'] )
			? absint( $settings['autoplay_speed'] )
			: 5000;
		?>

		<div
			id="<?= esc_attr( $uid ) ?>"
			class="<?= esc_attr( $class ) ?>"
			data-autoplay="<?= $autoplay ? 'true' : 'false' ?>"
			data-autoplay-speed="<?= esc_attr( $speed ) ?>"
		>

			<?php if ( $show_arrows ) : ?>

				<button
					type="button"
					class="pcw-arrow pcw-prev"
					aria-label="<?= esc_attr__( 'Previous portfolio items', 'app' ) ?>"
				>
					<span aria-hidden="true">&#8249;</span>
				</button>

			<?php endif; ?>

			<div class="pcw-viewport">

				<div class="pcw-track">

					<?php foreach ( $items as $item ) : ?>

						<?php
						$image_url = ! empty( $item['image']['url'] )
							? $item['image']['url']
							: \Elementor\Utils::get_placeholder_image_src();

						$image_id = ! empty( $item['image']['id'] )
							? absint( $item['image']['id'] )
							: 0;

						$title       = ! empty( $item['title'] ) ? $item['title'] : '';
						$category    = ! empty( $item['category'] ) ? $item['category'] : '';
						$button_text = ! empty( $item['button_text'] )
							? $item['button_text']
							: 'Read More';

						$link = ! empty( $item['link']['url'] )
							? $item['link']['url']
							: '#';

						$link_attrs = '';

						if ( ! empty( $item['link']['is_external'] ) ) {
							$link_attrs .= ' target="_blank"';
						}

						if ( ! empty( $item['link']['nofollow'] ) ) {
							$link_attrs .= ' rel="nofollow"';
						}
						?>

						<article class="pcw-slide">

							<div class="pcw-card">

								<a
									class="pcw-image"
									href="<?= esc_url( $link ) ?>"
									<?= $link_attrs ?>
								>

									<?php
									if ( $image_id ) {
										echo wp_get_attachment_image(
											$image_id,
											'large',
											false,
											[
												'loading' => 'lazy',
												'alt'     => wp_strip_all_tags( $title ),
											]
										);
									} else {
										?>
										<img
											src="<?= esc_url( $image_url ) ?>"
											alt="<?= esc_attr( wp_strip_all_tags( $title ) ) ?>"
											loading="lazy"
										>
										<?php
									}
									?>

								</a>

								<div class="pcw-content">

									<?php if ( $category ) : ?>

										<div class="pcw-category">
											<?= esc_html( $category ) ?>
										</div>

									<?php endif; ?>

									<h3 class="pcw-title">
										<?= esc_html( $title ) ?>
									</h3>

									<a
										class="pcw-button"
										href="<?= esc_url( $link ) ?>"
										<?= $link_attrs ?>
									>
										<?= esc_html( $button_text ) ?>
									</a>

								</div>

							</div>

						</article>

					<?php endforeach; ?>

				</div>

			</div>

			<?php if ( $show_arrows ) : ?>

				<button
					type="button"
					class="pcw-arrow pcw-next"
					aria-label="<?= esc_attr__( 'Next portfolio items', 'app' ) ?>"
				>
					<span aria-hidden="true">&#8250;</span>
				</button>

			<?php endif; ?>

			<?php if ( $show_dots ) : ?>

				<div
					class="pcw-pagination"
					aria-label="<?= esc_attr__( 'Portfolio pagination', 'app' ) ?>"
				></div>

			<?php endif; ?>

		</div>

		<script defer>
			jQuery(function($) {

				const element = $('#<?= esc_js( $uid ) ?>');

				if (!element.length || element.data('pcw-initialized')) {
					return;
				}

				element.data('pcw-initialized', true);

				const viewport = element.find('.pcw-viewport');
				const track = element.find('.pcw-track');
				const slides = element.find('.pcw-slide');

				const prev = element.find('.pcw-prev');
				const next = element.find('.pcw-next');
				const pagination = element.find('.pcw-pagination');

				let currentPage = 0;
				let totalPages = 1;
				let timer = null;

				let touchStartX = 0;
				let touchEndX = 0;

				const autoplay =
					element.data('autoplay') === true ||
					element.data('autoplay') === 'true';

				const autoplaySpeed =
					parseInt(
						element.attr('data-autoplay-speed'),
						10
					) || 5000;

				function getColumns() {

					const columns =
						parseInt(
							getComputedStyle(track[0])
								.getPropertyValue('--pcw-columns'),
							10
						) || 3;

					return Math.max(1, columns);
				}

				function getGap() {

					const gap =
						parseFloat(
							getComputedStyle(track[0])
								.getPropertyValue('--pcw-gap')
						) || 0;

					return gap;
				}

				function calculatePages() {

					const columns = getColumns();

					totalPages = Math.max(
						1,
						Math.ceil(slides.length / columns)
					);

					if (currentPage >= totalPages) {
						currentPage = totalPages - 1;
					}
				}

				function createPagination() {

					if (!pagination.length) {
						return;
					}

					pagination.empty();

					calculatePages();

					for (let i = 0; i < totalPages; i++) {

						const dot = $('<button>', {
							type: 'button',
							class: 'pcw-dot',
							'aria-label':
								'Go to portfolio page ' + (i + 1)
						});

						dot.on('click', function() {
							goTo(i);
							restartAutoplay();
						});

						pagination.append(dot);
					}
				}

				function update() {

					calculatePages();

					const columns = getColumns();
					const gap = getGap();

					const viewportWidth =
						viewport.outerWidth();

					const slideWidth =
						(
							viewportWidth -
							gap * (columns - 1)
						) / columns;

					const offset =
						currentPage *
						(columns * (slideWidth + gap));

					track.css(
						'transform',
						'translate3d(-' +
						offset +
						'px, 0, 0)'
					);

					updateNavigation();
				}

				function updateNavigation() {

					prev.toggleClass(
						'is-disabled',
						totalPages <= 1
					);

					next.toggleClass(
						'is-disabled',
						totalPages <= 1
					);

					pagination
						.find('.pcw-dot')
						.each(function(index) {

							const active =
								index === currentPage;

							$(this).toggleClass(
								'is-active',
								active
							);

							if (active) {
								$(this).attr(
									'aria-current',
									'true'
								);
							} else {
								$(this).removeAttr(
									'aria-current'
								);
							}
						});
				}

				function goTo(page) {

					currentPage = Math.max(
						0,
						Math.min(
							page,
							totalPages - 1
						)
					);

					update();
				}

				function nextPage() {

					if (totalPages <= 1) {
						return;
					}

					if (currentPage >= totalPages - 1) {
						currentPage = 0;
					} else {
						currentPage++;
					}

					update();
				}

				function previousPage() {

					if (totalPages <= 1) {
						return;
					}

					if (currentPage <= 0) {
						currentPage = totalPages - 1;
					} else {
						currentPage--;
					}

					update();
				}

				function stopAutoplay() {

					if (timer) {
						window.clearInterval(timer);
						timer = null;
					}
				}

				function startAutoplay() {

					if (!autoplay || totalPages <= 1) {
						return;
					}

					stopAutoplay();

					timer = window.setInterval(
						nextPage,
						autoplaySpeed
					);
				}

				function restartAutoplay() {

					if (!autoplay) {
						return;
					}

					startAutoplay();
				}

				function handleSwipe() {

					const difference =
						touchStartX - touchEndX;

					if (Math.abs(difference) < 40) {
						return;
					}

					if (difference > 0) {
						nextPage();
					} else {
						previousPage();
					}
				}

				prev.on('click', function() {
					previousPage();
					restartAutoplay();
				});

				next.on('click', function() {
					nextPage();
					restartAutoplay();
				});

				element.on(
					'mouseenter',
					function() {
						stopAutoplay();
					}
				);

				element.on(
					'mouseleave',
					function() {
						startAutoplay();
					}
				);

				viewport.on(
					'touchstart',
					function(event) {

						touchStartX =
							event.originalEvent
								.touches[0]
								.screenX;

						stopAutoplay();
					}
				);

				viewport.on(
					'touchend',
					function(event) {

						touchEndX =
							event.originalEvent
								.changedTouches[0]
								.screenX;

						handleSwipe();
						startAutoplay();
					}
				);

				let resizeTimer;

				$(window).on(
					'resize.pcw-' + '<?= esc_js( $uid ) ?>',
					function() {

						window.clearTimeout(
							resizeTimer
						);

						resizeTimer = window.setTimeout(
							function() {
								createPagination();
								update();
							},
							150
						);
					}
				);

				createPagination();
				update();
				startAutoplay();

			});
		</script>

		<?php
	}

	// DO NOT CHANGE/UPDATE BELOW FUNCTIONS IF NOT NECESSARY

	public function __construct( $data = [], $args = null ) {
		parent::__construct( $data, $args );
		$this->_register_assets();
	}

	public function get_name(): string {
		return __CLASS__;
	}

	public function get_categories(): array {
		return [ 'custom' ];
	}

	private function _register_assets() {
		$name = str_replace( '_', '-', strtolower( substr( $this->get_name(), 5 ) ) );

		wp_register_style(
			$this->_get_asset_handle(),
			get_theme_file_uri( "dist/css/$name.min.css" ),
			[],
			ASSETS_VERSION
		);
	}

	private function _get_asset_handle(): string {
		return "theme-{$this->get_name()}";
	}
}