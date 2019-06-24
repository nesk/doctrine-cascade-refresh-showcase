<?php

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity @Table(name="users")
 */
class User
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
     * @OneToMany(targetEntity="Project", mappedBy="user", cascade={"refresh"})
     **/
    private $projects;

    public function __construct()
    {
        $this->projects = new ArrayCollection;
    }

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

    public function getProjects()
    {
        return $this->projects;
    }

    public function addProject($project)
    {
        if (!$this->projects->contains($project)) {
            $this->projects[] = $project;
            $project->setUser($this);
        }

        return $this;
    }

    public function removeProject($project)
    {
        if ($this->projects->contains($project)) {
            $this->projects->removeElement($project);

            if ($project->getUser() === $this) {
                $project->setUser(null);
            }
        }

        return $this;
    }
}
