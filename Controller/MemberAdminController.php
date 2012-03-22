<?php

namespace BRS\MemberBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


use BRS\CoreBundle\Core\Widget\ListWidget;
use BRS\CoreBundle\Core\Widget\EditFormWidget;
use BRS\CoreBundle\Core\Widget\SearchFormWidget;
use BRS\CoreBundle\Core\Widget\PanelWidget;
use BRS\AdminBundle\Controller\AdminController;

use BRS\MemberBundle\Entity\Member;

use BRS\MemberBundle\Widget\MemberList;
use BRS\MemberBundle\Widget\MemberForm;

/**
 * Member controller.
 *
 * @Route("/admin/member")
 */
class MemberAdminController extends AdminController
{
		
	protected function setup()
	{
		parent::setup();
			
		$this->setRouteName('brs_member_memberadmin');
		$this->setEntityName('BRSMemberBundle:Member');
		$this->setEntity(new Member());
		
		
		$search_fields = array(
		
			'first_name' => array(
				'type' => 'text',
			),
			
			'last_name' => array(
				'type' => 'text',
			),
			
			'email' => array(
				'type' => 'text',
			),

			'city' => array(
				'type' => 'text',
			),

			'state' => array(
				'type' => 'text',
			),
		);
		
		$search_widget = new SearchFormWidget();
		$search_widget->setFields($search_fields);
		//$search_widget->setTitle('Search Members');
		$this->addWidget($search_widget, 'search_members');
		
		$list_widget = new MemberList();
		$list_widget->setSearchWidget($search_widget);
		$this->addWidget($list_widget, 'list_members');
		
		$list_panel = new PanelWidget();
		$this->addWidget($list_panel, 'list_panel');
		
		$list_panel->setWidgets(array(
			'search' => $search_widget,
			'list' => $list_widget,
		));
		
		$edit_widget = new MemberForm();
		$edit_widget->setTitle('Member Details');
		$edit_widget->setSuccessRoute('brs_member_memberadmin_edit');
		$this->addWidget($edit_widget, 'edit_member');
		
		$this->addView('index', $list_panel);
		$this->addView('new', $edit_widget);
		$this->addView('edit', $edit_widget);
		
	}
	
	public function getVars()
	{
		$vars = parent::getVars();
		
		$vars['widget_class'] = 'FormWidget';
					
		return $vars;
	}
	
}