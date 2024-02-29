<?php

namespace Modules\CongregateCms\Repositories;

use App\Cms\Page;
use Illuminate\Support\Collection;

class ContentRepository
{

    public function getLatestPost(): Page
    {
        return include content_dir('data/posts/latest.php');
    }

    public function findAPost(string | int $idOrSlug): Page | null
    {
        return (is_numeric($idOrSlug)) ? $this->findPostById($idOrSlug) : $this->findPostBySlug($idOrSlug);
    }

    public function getListOfPosts($total = 10): array
    {
        $lists = include content_dir('data/posts/list.php');
        return  $this->doSort(collect($lists))->splice(0, $total)->toArray();
    }

    public function getNextPost(string $slug): Page | null
    {
        $currentPost = $this->findPostBySlug($slug);
        if ($currentPost) {
            $posts = include content_dir('data/posts/list.php');
            return $this->doSort(collect($posts))->reverse()->first(function ($item) use ($currentPost) {
                return ($item->id - 1) >= $currentPost->id;
            });
        }

        return null;
    }

    public function getPreviousPost(string $slug): Page | null
    {
        $currentPost = $this->findPostBySlug($slug);

        if ($currentPost) {
            $posts = include content_dir('data/posts/list.php');
            return $this->doSort(collect($posts))->filter(function ($item) use ($currentPost) {
                return $item->id < $currentPost->id;
            })->first();
        }
        return null;
    }

    public function findPostById(int $id): Page | null
    {
        try {
            return require(content_dir("data/posts/{$id}.php"));
        } catch (\Exception $_) {
            return null;
        }
    }

    public function findPostBySlug(string $slug): Page | null
    {
        try {
            $posts = include content_dir('data/posts/list.php');
            return collect($posts)->first(function ($value) use ($slug) {
                return $value->slug == $slug;
            });
        } catch (\Exception $_) {
            return null;
        }
    }

    public function findAPage(string | int $idOrSlug): Page | null
    {
        return (is_numeric($idOrSlug)) ? $this->findPageById($idOrSlug) : $this->findPageBySlug($idOrSlug);
    }

    public function findPageById(int $id): Page | null
    {
        try {
            return require(content_dir("data/pages/{$id}.php"));
        } catch (\Exception $_) {
            return null;
        }
    }

    public function findPageBySlug(string $slug): Page | null
    {
        try {
            $pages = include(content_dir('data/pages/list.php'));
            return collect($pages)->sole(function ($value) use ($slug) {
                return $value->slug == $slug;
            });
        } catch (\Exception $_) {
            return null;
        }
    }

    private function doSort(Collection $collection): Collection
    {
        return $collection->sort(function ($a, $b) {
            return $a->id < $b->id ? 1 : -1;
        });
    }
}
