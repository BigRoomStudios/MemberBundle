<?php

namespace BRS\MemberBundle\Widget;

use BRS\CoreBundle\Core\Widget\ListWidget;

/**
 * Member list widget
 * 
 */
class MemberList extends ListWidget
{
		
	//protected $template = 'BRSCoreBundle:Widget:member_list.html.twig';
		
	public function __construct()
	{
		parent::__construct();	
		
		$this->setEntityName('BRSMemberBundle:Member');
		
		$list_fields = array(
	
			'edit' => array(
				'type' => 'link',
				'route' => array(
					'name' => 'brs_member_memberadmin_edit',
					'params' => array('id'),
				),
				'nav' => true,
				'label' => 'edit',
				'width' => 55,
				'nonentity' => true,
				'class' => 'btn btn-mini',
			),
			
			'first_name' => array(
				'type' => 'text',
			),
			
			'last_name' => array(
				'type' => 'text',
			),
			
			'email' => array(
				'type' => 'email',
				//'width' => 100,
			),

			'city' => array(
				'type' => 'text',
			),
			
			'state' => array(
				'type' => 'text',
			),
		);
		
		$this->setListFields($list_fields);
	}
}
	