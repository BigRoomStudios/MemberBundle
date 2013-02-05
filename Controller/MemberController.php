<?php

namespace BRS\MemberBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use BRS\CoreBundle\Core\WidgetController;
use BRS\CoreBundle\Core\Utility as BRS;
use BRS\ProjectBundle\Controller\DefaultController as ProjectController;
use BRS\MemberBundle\Widget\MemberForm;
use BRS\MemberBundle\Entity\Member;

/**
 * Member controller.
 *
 * @Route("/member")
 */
class MemberController extends WidgetController
{
	
	protected function setup()
	{		
		parent::setup();
		
		$this->setRouteName('brs_member_member');
		$this->setEntityName('BRSMemberBundle:Member');
		$this->setEntity(new Member());
		
		$edit_widget = new MemberForm();
		$edit_widget->setSuccessRoute('brs_member_member_account');
		$this->addWidget($edit_widget, 'my_account');
		$this->addView('edit', $edit_widget);
	}	
 
	/**
     * @Route("/account")
     * @Template("BRSMemberBundle:Default:account.html.twig")
     */
    public function accountAction()
    {
 		$user = $this->getUser();
		
 		$view = $this->getView('edit');
				
		$view->getById($user->id);
		
		$view->handleRequest();
		
		$values = array(
		
			'view' => $view->render(),
		);
			
        return $values;
    }
	
	/**
     * @Route("/list")
     * @Template("BRSMemberBundle:Default:member.list.html.twig")
     */
    public function memberListAction()
    {
 			
		$template = $this->getQuery('template');	
			
 		$repo = $this->getRepository('BRSMemberBundle:Member');
			
        $members = $repo->findBy(array(),array());
		
		$values = array(
			'members' => $members,
		);
		
		if($template){
			
			return $this->response($this->renderTemplate($template, $values));
			
		}else{
		
     	   return $values;
		}
    }
	
}
