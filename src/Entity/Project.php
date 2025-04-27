<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjectRepository::class)]
class Project
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nameProject = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $startDate = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $endDate = null;

    /**
     * @var Collection<int, Employee>
     */
    #[ORM\ManyToMany(targetEntity: Employee::class, inversedBy: 'projects')]
    private Collection $Employees;

    public function __construct()
    {
        $this->Employees = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameProject(): ?string
    {
        return $this->nameProject;
    }

    public function setNameProject(string $nameProject): static
    {
        $this->nameProject = $nameProject;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): static
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(?\DateTimeInterface $endDate): static
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * @return Collection<int, Employee>
     */
    public function getEmployees(): Collection
    {
        return $this->Employees;
    }

    public function addEmployee(Employee $employee): static
    {
        if (!$this->Employees->contains($employee)) {
            $this->Employees->add($employee);
        }

        return $this;
    }

    public function removeEmployee(Employee $employee): static
    {
        $this->Employees->removeElement($employee);

        return $this;
    }
}
