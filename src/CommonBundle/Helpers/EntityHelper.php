<?php


namespace CommonBundle\Helpers;

use CommonBundle\Controller\BaseController;
use DBBundle\Entity\AdminUser;

use DBBundle\Entity\Userrole;
use DBBundle\Entity\Users;
use DBBundle\Form\AdminUserType;
use DBBundle\Form\UserroleType;
use DBBundle\Form\UsersType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class EntityHelper extends BaseController
{

    const ADMINUSER = "AdminUser";
    const USERROLE = "Userrole";
    const USERTYPE = "Usertype";
    const USERSROLES = "Usersroles";
    const DASHBOARD = "Dashboard";
    const USERSDATA = "users";
    const ERROR = "Error";
    const USERS = "users";
    const USERDATA = "Users";
    const ROLE = "Role";
    const USERDATAEDIT = "Editusers";
    const USERDATAADD = "Addusers";
    const ITEMTYPE = "itemType";
    const MESSAGE = "message";
    const CODE = "code";
    const LINE = "Line";
    const ITEMS = "items";
    const ITEMTITLE = "itemTitle";
    const SITELOGOUT = "site_logout";
    const ADMINITMEADDEDIT = "admin_item_addedit";
    const ADMINITEMLIST = "admin_item_list";
    const ADMINITEMLISTUSER = "admin_item_list_user";
    const ITEMFORM = "itemform";
    const ACTION = "action";
    const METHOD = "method";
    const ID = "id";
    const ZERO = 0;
    const ONE = 1;

    private $em;

    public function __construct (ObjectManager $entityManager)
    {
        $this->em = $entityManager;
    }

    public function Entity($entityName, $id)
    {
        $entity = $this->EntityRepository ($entityName)->find ($id);
        if(isset($entity)) {
            return $entity;
        } else {
            switch ($entityName) {
                case EntityHelper::ADMINUSER:
                    return new AdminUser();
                case EntityHelper::USERROLE:
                    return new Userrole();

            }
        }
        throw new \Exception('Not Found Entity');
    }

    public function EntityRepository($entityName)
    {
        switch ($entityName) {
            case EntityHelper::ADMINUSER:
                return $this->em->getRepository('DBBundle:AdminUser');
            case EntityHelper::USERROLE:
                return $this->em->getRepository('DBBundle:Userrole');
            case EntityHelper::USERDATA:
                return $this->em->getRepository('DBBundle:Users');
            case EntityHelper::USERSROLES:
                return $this->em->getRepository('DBBundle:Usersroles');





        }
        throw new \Exception('Not Found Repository');
    }
    public function EntityRepositorypath($entityName)
    {
        switch ($entityName) {
            case EntityHelper::ADMINUSER:
                return 'DBBundle:AdminUser';
            case EntityHelper::USERROLE:
                return 'DBBundle:Userrole';
            case EntityHelper::USERDATA:
                return 'DBBundle:Users';









        }
        throw new \Exception('Not Found Entity Repository Path');
    }

    public function EntityForm($entityName)
    {
        switch ($entityName) {
            case EntityHelper::ADMINUSER:
                return AdminUserType::class;
            case EntityHelper::USERROLE:
                return UserroleType::class;






        }
        throw new \Exception('Not Found Entity Form type');
    }

    public function EntityTitle ($entityName)
    {
        switch ($entityName) {
            case EntityHelper::ADMINUSER:
                return "Admin User";
            case EntityHelper::USERROLE:
                return "User Role";
            case EntityHelper::USERDATA:
                return "Users";
            case EntityHelper::USERDATAADD:
                return "Add User";
            case EntityHelper::USERDATAEDIT:
                return "Edit User";
            case EntityHelper::ROLE:
                return "Role";





        }
        throw new \Exception('Not Found Entity Title');
    }

    public function ListTwig($entityName)
    {
        switch ($entityName) {
            case EntityHelper::ADMINUSER:
            case EntityHelper::USERROLE:
            case EntityHelper::ROLE:
                return "@Admin/Items/index.html.twig";
            case EntityHelper::DASHBOARD:
                return "@Admin/Dashboard/index.html.twig";
            case EntityHelper::ERROR:
                return "@Admin/Error/index.html.twig";
            case EntityHelper::USERDATA:
            case EntityHelper::USERDATAADD:
            case EntityHelper::USERDATAEDIT:
                return "@Admin/Users/index.html.twig";


        }
        throw new \Exception('Not Found Entity Twig List');
    }

    public function DetailsTwig($entityName)
    {
        switch ($entityName) {
            case EntityHelper::ADMINUSER:
            case EntityHelper::USERROLE:
            case EntityHelper::ROLE:
                return "@Admin/Items/form/itemform.html.twig";
            case EntityHelper::USERDATA:
                return "@Admin/Users/form/itemform.html.twig";


        }
        throw new \Exception('Not Found Entity Detail twig');
    }



}