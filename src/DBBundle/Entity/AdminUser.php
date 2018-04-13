<?php

namespace DBBundle\Entity;

use CommonBundle\Helpers\DateHelper;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
use CommonBundle\Doctrine\ORM\Behaviours\BlameableTrait;
use CommonBundle\Doctrine\ORM\Behaviours\TimestampableTrait;

/**
 * User
 * @ORM\Entity(repositoryClass="DBBundle\Repository\AdminUserRepository")
 * @ORM\Table(name="adminuser", uniqueConstraints={@ORM\UniqueConstraint(name="Email", columns={"Email"})})
 * @ORM\HasLifecycleCallbacks()
 * @Vich\Uploadable

 */
class AdminUser
{
    const ID = 'id';
    const NAME = 'name';
    const EMAIL = 'email';
    const STATUS = 'status';
    const MOBILE = 'mobile';
    use TimestampableTrait,BlameableTrait;
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Name", type="string", length=250, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="Email", type="string", length=250, nullable=false)
     */
    private $email;
    /**
     * @var string
     *
     * @ORM\Column(name="Status", type="string", length=10, nullable=true)
     */
    private $status;
    /**
     * @var string
     *
     * @ORM\Column(name="Mobile", type="string", length=250, nullable=false)
     */
    private $mobile;
    /**
     * @var string
     *
     * @ORM\Column(name="Password", type="string", length=250, nullable=false)
     */
//    private $password;
    private $password='e10adc3949ba59abbe56e057f20f883e';
    /**
     * @var \DBBundle\Entity\Userrole
     *
     * @ORM\ManyToOne(targetEntity="DBBundle\Entity\Userrole")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Userrole", referencedColumnName="id")
     * })
     */
    private $userrole;
    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="global_image", fileNameProperty="imageName", size="imageSize")
     *
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     *
     * @var string
     */
    private $imageName;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     * @var integer
     */
    private $imageSize;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $updatedAt;


    public static  function convertObjectToArray(AdminUser $item) {
        if ($item->getId() > 0) {
            return array(
                'id' => $item->getId() ? $item->getId() : '',
                'name' => $item->getName() ? $item->getName() : '',

            );
        } else {

            return array();
        }

    }
    public static function convertObjectsToArray($objs) {
        $results = array();
        if (count($objs) > 0) {
            foreach ($objs as $obj) {
                if ($obj->getId() > 0) {

                    array_push($results, AdminUser::convertObjectToArray($obj));
                }
            }
        }
        return $results;
    }


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return AdminUser
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return AdminUser
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return AdminUser
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set mobile
     *
     * @param string $mobile
     * @return AdminUser
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;

        return $this;
    }

    /**
     * Get mobile
     *
     * @return string 
     */
    public function getMobile()
    {
        return $this->mobile;
    }



    /**
     * Set userrole
     *
     * @param \DBBundle\Entity\Userrole $userrole
     * @return AdminUser
     */
    public function setUserrole(\DBBundle\Entity\Userrole $userrole = null)
    {
        $this->userrole = $userrole;

        return $this;
    }

    /**
     * Get userrole
     *
     * @return \DBBundle\Entity\Userrole 
     */
    public function getUserrole()
    {
        return $this->userrole;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return AdminUser
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }
    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     */
    public function setImageFile(?File $image = null)
    {
        $this->imageFile = $image;

        if (null !== $image) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function setImageName(?string $imageName)
    {
        $this->imageName = $imageName;
    }

    public function getImageName()
    {
        return $this->imageName;
    }

    public function setImageSize(?int $imageSize)
    {
        $this->imageSize = $imageSize;
    }

    public function getImageSize()
    {
        return $this->imageSize;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return AdminUser
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}
