<?php

/**
 * @Entity @Table(name="projects")
 */
class Project
{
    /**
     * @Id @Column(type="integer") @GeneratedValue
     * @var int
     */
    private $id;

    /**
     * @Column(type="string")
     * @var string
     */
    private $name;

    /**
     * @ManyToOne(targetEntity="User", inversedBy="projects", cascade={"refresh"})
     **/
    private $user;

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user)
    {
        if ($user !== null) {
            $user->addProject($this);
        } else {
            $this->user->removeProject($this);
        }

        $this->user = $user;

        return $this;
    }
}
