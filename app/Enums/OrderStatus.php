<?php

namespace App\Enums;

enum OrderStatus: string
{
    case PENDING    = 'pending';
    case PROCESSING = 'processing';
    case COMPLETED    = 'completed';
    case CANCELLED  = 'cancelled';

    /**
     * Получить русское название статуса.
     *
     * @return string
     */
    public function ruName(): string
    {
        return match($this) {
            self::PENDING    => 'В ожидании',
            self::PROCESSING => 'В обработке',
            self::COMPLETED    => 'Выполнен',
            self::CANCELLED  => 'Отменен',
        };
    }

    /**
     * Проверяет, можно ли отменить данный статус.
     *
     * @return bool
     */
    public function canBeCancelled(): bool
    {
        return in_array($this, [self::PENDING, self::PROCESSING]);
    }
}