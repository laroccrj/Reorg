<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PaymentSearchExportTaskRepository")
 */
class PaymentSearchExportTask
{
  /**
   * @ORM\Id()
   * @ORM\GeneratedValue()
   * @ORM\Column(type="integer")
   */
  private $id;

  /**
   * @ORM\Column(type="string", length=127, nullable=true)
   */
  private $search_field;

  /**
   * @ORM\Column(type="string", length=255, nullable=true)
   */
  private $search_value;

  /**
   * @ORM\Column(type="boolean")
   */
  private $started;

  /**
   * @ORM\Column(type="boolean")
   */
  private $complete;

  /**
   * @ORM\Column(type="string", length=255, nullable=true)
   */
  private $filepath;

  public function getId(): ?int
  {
    return $this->id;
  }

  public function getSearchField(): ?string
  {
    return $this->search_field;
  }

  public function setSearchField(?string $search_field): self
  {
    $this->search_field = $search_field;

    return $this;
  }

  public function getSearchValue(): ?string
  {
    return $this->search_value;
  }

  public function setSearchValue(?string $search_value): self
  {
    $this->search_value = $search_value;

    return $this;
  }

  public function getStarted(): ?bool
  {
    return $this->started;
  }

  public function setStarted(bool $started): self
  {
    $this->started = $started;

    return $this;
  }

  public function getComplete(): ?bool
  {
    return $this->complete;
  }

  public function setComplete(bool $complete): self
  {
    $this->complete = $complete;

    return $this;
  }

  public function getFilepath(): ?string
  {
    return $this->filepath;
  }

  public function setFilepath(?string $filepath): self
  {
    $this->filepath = $filepath;

    return $this;
  }
}
