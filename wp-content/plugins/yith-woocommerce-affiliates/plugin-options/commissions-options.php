<?php
/**
 * Commission options
 *
 * @author  YITH
 * @package YITH\Affiliates
 * @version 1.0.0
 */

if ( ! defined( 'YITH_WCAF' ) ) {
	exit;
} // Exit if accessed directly

return apply_filters(
	'yith_wcaf_commissions_settings',
	array(
		'commissions' => array(
			'commissions_options' => array(
				'type'     => 'multi_tab',
				'sub-tabs' => array(
					'commissions-list'     => array(
						'title' => _x( 'Commissions List', '[ADMIN] Affiliate tab title', 'yith-woocommerce-affiliates' ),
					),
					'commissions-payments' => array(
						'title' => _x( 'Commissions Payments', '[ADMIN] Affiliate tab title', 'yith-woocommerce-affiliates' ),
					),
				),
			),
		),
	)
);
