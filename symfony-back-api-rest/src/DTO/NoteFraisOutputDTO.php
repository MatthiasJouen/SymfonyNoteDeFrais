<?php

namespace App\DTO;

class NoteFraisOutputDTO
{
    public int $id;
    public \DateTimeInterface $date;
    public string $user;
    public float $amount;
    public \DateTimeInterface $saveDate;
    public string $noteType;
    public string $company;
}