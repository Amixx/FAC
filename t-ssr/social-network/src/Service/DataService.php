<?php

namespace App\Service;

use App\Entity\SpentTime;
use App\Entity\TodoItem;
use App\Entity\TodoItemCategory;
use App\Repository\SpentTimeRepository;
use App\Repository\TodoItemCategoryRepository;
use App\Repository\TodoItemRepository;
use Symfony\Component\HttpFoundation\RequestStack;

class DataService
{
    private RequestStack $requestStack;

    public function __construct(
        RequestStack $requestStack,
    )
    {
        $this->requestStack = $requestStack;
    }

    public function authenticate($data): ?string
    {
        // simulate authentication
        sleep(0.5);
        $this->requestStack->getSession()->set('is_authenticated', true);
        return 'todos';
    }

    public function logout(): ?string
    {
        $this->requestStack->getSession()->remove('is_authenticated');
        return 'authenticate';
    }


}