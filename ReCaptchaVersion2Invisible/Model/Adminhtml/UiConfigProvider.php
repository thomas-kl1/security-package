<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magento\ReCaptchaVersion2Invisible\Model\Adminhtml;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\ReCaptchaUi\Model\UiConfigProviderInterface;

/**
 * @inheritdoc
 */
class UiConfigProvider implements UiConfigProviderInterface
{
    private const XML_PATH_PUBLIC_KEY = 'recaptcha_backend/type_invisible/public_key';
    private const XML_PATH_POSITION = 'recaptcha_backend/type_invisible/position';
    private const XML_PATH_THEME = 'recaptcha_backend/type_invisible/theme';
    private const XML_PATH_LANGUAGE_CODE = 'recaptcha_backend/type_invisible/lang';

    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * Get language code
     *
     * @return string
     */
    private function getLanguageCode(): string
    {
        return (string)$this->scopeConfig->getValue(self::XML_PATH_LANGUAGE_CODE);
    }

    /**
     * Get Google API Website Key
     *
     * @return string
     */
    private function getPublicKey(): string
    {
        return trim((string)$this->scopeConfig->getValue(self::XML_PATH_PUBLIC_KEY));
    }

    /**
     * Get Invisible Badge Position
     *
     * @return string
     */
    private function getInvisibleBadgePosition(): string
    {
        return (string)$this->scopeConfig->getValue(self::XML_PATH_POSITION);
    }

    /**
     * Get theme
     *
     * @return string
     */
    private function getTheme(): string
    {
        return (string)$this->scopeConfig->getValue(self::XML_PATH_THEME);
    }

    /**
     * @inheritdoc
     */
    public function get(): array
    {
        return [
            'rendering' => [
                'sitekey' => $this->getPublicKey(),
                'badge' => $this->getInvisibleBadgePosition(),
                'size' => 'invisible',
                'theme' => $this->getTheme(),
                'hl'=> $this->getLanguageCode()
            ],
            'invisible' => true,
        ];
    }
}
