<?php

namespace DocFlow;

use MyCLabs\Enum\Enum;

/**
 * @method static Status DRAFT()
 * @method static Status VERIFY()
 * @method static Status PUBLISHED()
 */
final class Status extends Enum
{
    private const DRAFT = 'draft';
    private const VERIFY = 'verify';
    private const PUBLISHED = 'published';
}