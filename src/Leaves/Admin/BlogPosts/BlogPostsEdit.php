<?php

namespace SuperCMS\Leaves\Admin\BlogPosts;

use Rhubarb\Crown\Exceptions\ForceResponseException;
use Rhubarb\Crown\Response\RedirectResponse;

class BlogPostsEdit extends BlogPostsItem
{
    /**
     * @throws ForceResponseException
     */
    protected function redirectAfterSave()
    {
        throw new ForceResponseException(new RedirectResponse('../../'));
    }
}