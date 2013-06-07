<?php

namespace Site\UtilisateurBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Site\UtilisateurBundle\Entity\Utilisateur
 *
 * @ORM\Table(name="utilisateur")
 * @ORM\Entity
 */
class Utilisateur
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @var string $pseudo
     *
     * @ORM\Column(name="pseudo", type="string", length=15)
     */
    private $pseudo;
    
    /**
     * @var string $password
     *
     * @ORM\Column(name="password", type="string", length=50)
     */
    private $password;
    

    /**
     * @var string $rang
     *
     * @ORM\Column(name="rang", type="string", length=30)
     */
    private $rang;

    public function __construct()
    {
        
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
     * Set pseudo
     *
     * @param string $pseudo
     * @return Utilisateur
     */
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
    
        return $this;
    }

    /**
     * Get pseudo
     *
     * @return string 
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Utilisateur
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
     * Set rang
     *
     * @param string $rang
     * @return Utilisateur
     */
    public function setRang($rang)
    {
        $this->rang = $rang;
    
        return $this;
    }

    /**
     * Get rang
     *
     * @return string 
     */
    public function getRang()
    {
        return $this->rang;
    }
}