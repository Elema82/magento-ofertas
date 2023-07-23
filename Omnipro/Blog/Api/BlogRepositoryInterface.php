<?php
namespace Omnipro\Blog\Api;

interface BlogRepositoryInterface
{
    /**
     * Guarda o actualiza una publicación del Blog.
     *
     * @param array $data
     * @return \Omnipro\Blog\\Api\Data\BlogInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function savePost(array $data);

    /**
     * Elimina una publicación del Blog por su ID.
     *
     * @param int $postId
     * @return bool
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deletePostById($postId);
}
