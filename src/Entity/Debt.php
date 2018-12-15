<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Debt
 *
 * @ORM\Table(name="debt", indexes={@ORM\Index(name="fk_debt_person2_idx", columns={"to_id"}), @ORM\Index(name="fk_debt_person1_idx", columns={"from_id"})})
 * @ORM\Entity
 */
class Debt
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    /**
     * @var string
     *
     * @ORM\Column(name="amount", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $amount;
    /**
     * @var bool
     *
     * @ORM\Column(name="paid", type="boolean", nullable=false)
     */
    private $paid = '0';
    /**
     * @var Person
     *
     * @ORM\ManyToOne(targetEntity="Person")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="from_id", referencedColumnName="id")
     * })
     */
    private $from;
    /**
     * @var Person
     *
     * @ORM\ManyToOne(targetEntity="Person")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="to_id", referencedColumnName="id")
     * })
     */
    private $to;
    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
    /**
     * @param int $id
     * @return Debt
     */
    public function setId(int $id): Debt
    {
        $this->id = $id;
        return $this;
    }
    /**
     * @return string
     */
    public function getAmount(): string
    {
        return $this->amount;
    }
    /**
     * @param string $amount
     * @return Debt
     */
    public function setAmount(string $amount): Debt
    {
        $this->amount = $amount;
        return $this;
    }
    /**
     * @return bool
     */
    public function isPaid(): bool
    {
        return $this->paid;
    }
    /**
     * @param bool $paid
     * @return Debt
     */
    public function setPaid(bool $paid): Debt
    {
        $this->paid = $paid;
        return $this;
    }
    /**
     * @return Person
     */
    public function getFrom(): Person
    {
        return $this->from;
    }
    /**
     * @param Person $from
     * @return Debt
     */
    public function setFrom(Person $from): Debt
    {
        $this->from = $from;
        return $this;
    }
    /**
     * @return Person
     */
    public function getTo(): Person
    {
        return $this->to;
    }
    /**
     * @param Person $to
     * @return Debt
     */
    public function setTo(Person $to): Debt
    {
        $this->to = $to;
        return $this;
    }
}