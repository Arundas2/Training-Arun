<?php
/**
 * @package Ceymox_Customshipping
 */
declare(strict_types=1);

namespace Ceymox\CustomShipping\Model;

use Magento\Quote\Model\Quote\Address\RateResult\Error;
use Magento\Quote\Model\Quote\Address\RateRequest;
use Magento\Shipping\Model\Carrier\AbstractCarrier;
use Magento\Shipping\Model\Carrier\CarrierInterface;
use Magento\Shipping\Model\Simplexml\Element;

class Carrier extends AbstractCarrier implements CarrierInterface
{
    /**
     * @var const CODE
     */
    public const CODE = 'customshipping';

    /**
     * @var $_code
     */
    protected $_code = self::CODE;
    
    /**
     * Constructor
     *
     * @param Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     * @param Magento\Quote\Model\Quote\Address\RateResult\ErrorFactory $rateErrorFactory
     * @param Psr\Log\LoggerInterface $logger
     * @param Magento\Shipping\Model\Rate\ResultFactory $rateFactory
     * @param Magento\Quote\Model\Quote\Address\RateResult\MethodFactory $rateMethodFactory
     * @param Magento\Shipping\Model\Tracking\ResultFactory $trackFactory
     * @param Magento\Shipping\Model\Tracking\Result\ErrorFactory $trackErrorFactory
     * @param Magento\Shipping\Model\Tracking\Result\StatusFactory $trackStatusFactory
     * @param Magento\Directory\Model\RegionFactory $regionFactory
     * @param Magento\Directory\Model\CountryFactory $countryFactory
     * @param Magento\Directory\Model\CurrencyFactory $currencyFactory
     * @param Magento\Directory\Helper\Data $directoryData
     * @param Magento\CatalogInventory\Api\StockRegistryInterface $stockRegistry
     * @param Magento\Framework\Locale\FormatInterface $localeFormat
     * @param array $data
     */
    public function __construct(
        protected \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        protected \Magento\Quote\Model\Quote\Address\RateResult\ErrorFactory $rateErrorFactory,
        protected \Psr\Log\LoggerInterface $logger,
        protected \Magento\Shipping\Model\Rate\ResultFactory $rateFactory,
        protected \Magento\Quote\Model\Quote\Address\RateResult\MethodFactory $rateMethodFactory,
        protected \Magento\Shipping\Model\Tracking\ResultFactory $trackFactory,
        protected \Magento\Shipping\Model\Tracking\Result\ErrorFactory $trackErrorFactory,
        protected \Magento\Shipping\Model\Tracking\Result\StatusFactory $trackStatusFactory,
        protected \Magento\Directory\Model\RegionFactory $regionFactory,
        protected \Magento\Directory\Model\CountryFactory $countryFactory,
        protected \Magento\Directory\Model\CurrencyFactory $currencyFactory,
        protected \Magento\Directory\Helper\Data $directoryData,
        protected \Magento\CatalogInventory\Api\StockRegistryInterface $stockRegistry,
        protected \Magento\Framework\Locale\FormatInterface $localeFormat,
        array $data = []
    ) {
        parent::__construct($scopeConfig, $rateErrorFactory, $logger, $data);
    }

    /**
     * Function getAllowedMethods
     * 
     * @return $this
     */
    public function getAllowedMethods()
    {
        return $this;
    }
    
    /**
     * Collect and get rates
     *
     * @param RateRequest $request
     * @return Result
     */
    public function collectRates(RateRequest $request)
    {

        $specificCountry = 'IN';
        $specificState = 586;
        $countryId = $request->getDestCountryId();
        $regionId = $request->getDestRegionId();
        if ($countryId == $specificCountry && $specificState == $regionId) {
            $result = $this->rateFactory->create();
            $method = $this->rateMethodFactory->create();
            $method->setCarrier($this->_code);
            $method->setCarrierTitle('Free Shipping');
            $method->setMethod($this->_code);
            $method->setMethodTitle('Free Shipping');
            $method->setCost(0.0);
            $method->setPrice(0.0);
            $result->append($method);
            return $result;
        }
    }
    
    /**
     * Processing additional validation 
     *
     * @param \Magento\Framework\DataObject $request
     * @return $this
     */
    public function proccessAdditionalValidation(\Magento\Framework\DataObject $request)
    {
        return true;
    }
}
