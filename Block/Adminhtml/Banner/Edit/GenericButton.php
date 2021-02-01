<?php
/**
 * GiaPhuGroup Co., Ltd.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the GiaPhuGroup.com license that is
 * available through the world-wide-web at this URL:
 * https://www.giaphugroup.com/LICENSE.txt
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    PHPCuong
 * @package     PHPCuong_BannerSlider
 * @copyright   Copyright (c) 2018-2019 GiaPhuGroup Co., Ltd. All rights reserved. (http://www.giaphugroup.com/)
 * @license     https://www.giaphugroup.com/LICENSE.txt
 */

namespace PHPCuong\BannerSlider\Block\Adminhtml\Banner\Edit;

use Magento\Framework\View\Element\UiComponent\Context;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Class GenericButton
 */
class GenericButton implements ButtonProviderInterface
{
    /**
     * @var Context
     */
    protected $context;

    /**
     * @var \Magento\Framework\AuthorizationInterface
     */
    protected $_authorization;

    /**
     * @param Context $context
     * @param \Magento\Framework\AuthorizationInterface $authorization
     */
    public function __construct(
        Context $context,
        \Magento\Framework\AuthorizationInterface $authorization
        \Magento\Framework\Webapi\Rest\Request $request  //<-- added 

    ) {
        $this->context = $context;
        $this->_authorization = $authorization;
        $this->_request = $request;  // <--added

    }

    /**
     * Return the Banner ID
     *
     * @return int
     */
    public function getBannerId()
    {
        // return (int)$this->context->getRequest()->getParam('id');
        return (int)$this->_request->getParams('id');  //<-- changed

    }

    /**
     * Generate url by route and parameters
     *
     * @param   string $route
     * @param   array $params
     * @return  string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }

    /**
     * {@inheritdoc}
     */
    public function getButtonData()
    {
        return [];
    }

    /**
     * Check permission for passed action
     *
     * @param string $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
}
