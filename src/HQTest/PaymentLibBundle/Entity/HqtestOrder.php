<?php

namespace HQTest\PaymentLibBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * HqtestOrder
 */
class HqtestOrder
{
    /**
     * @var string
     */
    private $customerName;

    /**
     * @var string
     */
    private $cardHolderName;

    /**
     * @var string
     */
    private $cardNumber;

    /**
     * @var string
     */
    private $cardType;

    /**
     * @var string
     */
    private $cardExpiry;

    /**
     * @var string
     */
    private $cardCvv;

    /**
     * @var string
     */
    private $paymentCurrency;

    /**
     * @var string
     */
    private $paymentGateway;

    /**
     * @var string
     */
    private $transactionId;

    /**
     * @var string
     */
    private $orderStatus;

    /**
     * @var string
     */
    private $orderAmount;

    /**
     * @var \DateTime
     */
    private $orderCreatedTime;

    /**
     * @var string
     */
    private $transactionResponse;

    /**
     * @var integer
     */
    private $orderId;


    /**
     * Set customerName
     *
     * @param string $customerName
     * @return HqtestOrder
     */
    public function setCustomerName($customerName)
    {
        $this->customerName = $customerName;

        return $this;
    }

    /**
     * Get customerName
     *
     * @return string 
     */
    public function getCustomerName()
    {
        return $this->customerName;
    }

    /**
     * Set cardHolderName
     *
     * @param string $cardHolderName
     * @return HqtestOrder
     */
    public function setCardHolderName($cardHolderName)
    {
        $this->cardHolderName = $cardHolderName;

        return $this;
    }

    /**
     * Get cardHolderName
     *
     * @return string 
     */
    public function getCardHolderName()
    {
        return $this->cardHolderName;
    }

    /**
     * Set cardNumber
     *
     * @param string $cardNumber
     * @return HqtestOrder
     */
    public function setCardNumber($cardNumber)
    {
        $this->cardNumber = $cardNumber;

        return $this;
    }

    /**
     * Get cardNumber
     *
     * @return string 
     */
    public function getCardNumber()
    {
        return $this->cardNumber;
    }

    /**
     * Set cardType
     *
     * @param string $cardType
     * @return HqtestOrder
     */
    public function setCardType($cardType)
    {
        $this->cardType = $cardType;

        return $this;
    }

    /**
     * Get cardType
     *
     * @return string 
     */
    public function getCardType()
    {
        return $this->cardType;
    }

    /**
     * Set cardExpiry
     *
     * @param string $cardExpiry
     * @return HqtestOrder
     */
    public function setCardExpiry($cardExpiry)
    {
        $this->cardExpiry = $cardExpiry;

        return $this;
    }

    /**
     * Get cardExpiry
     *
     * @return string 
     */
    public function getCardExpiry()
    {
        return $this->cardExpiry;
    }

    /**
     * Set cardCvv
     *
     * @param string $cardCvv
     * @return HqtestOrder
     */
    public function setCardCvv($cardCvv)
    {
        $this->cardCvv = $cardCvv;

        return $this;
    }

    /**
     * Get cardCvv
     *
     * @return string 
     */
    public function getCardCvv()
    {
        return $this->cardCvv;
    }

    /**
     * Set paymentCurrency
     *
     * @param string $paymentCurrency
     * @return HqtestOrder
     */
    public function setPaymentCurrency($paymentCurrency)
    {
        $this->paymentCurrency = $paymentCurrency;

        return $this;
    }

    /**
     * Get paymentCurrency
     *
     * @return string 
     */
    public function getPaymentCurrency()
    {
        return $this->paymentCurrency;
    }

    /**
     * Set paymentGateway
     *
     * @param string $paymentGateway
     * @return HqtestOrder
     */
    public function setPaymentGateway($paymentGateway)
    {
        $this->paymentGateway = $paymentGateway;

        return $this;
    }

    /**
     * Get paymentGateway
     *
     * @return string 
     */
    public function getPaymentGateway()
    {
        return $this->paymentGateway;
    }

    /**
     * Set transactionId
     *
     * @param string $transactionId
     * @return HqtestOrder
     */
    public function setTransactionId($transactionId)
    {
        $this->transactionId = $transactionId;

        return $this;
    }

    /**
     * Get transactionId
     *
     * @return string 
     */
    public function getTransactionId()
    {
        return $this->transactionId;
    }

    /**
     * Set orderStatus
     *
     * @param string $orderStatus
     * @return HqtestOrder
     */
    public function setOrderStatus($orderStatus)
    {
        $this->orderStatus = $orderStatus;

        return $this;
    }

    /**
     * Get orderStatus
     *
     * @return string 
     */
    public function getOrderStatus()
    {
        return $this->orderStatus;
    }

    /**
     * Set orderAmount
     *
     * @param string $orderAmount
     * @return HqtestOrder
     */
    public function setOrderAmount($orderAmount)
    {
        $this->orderAmount = $orderAmount;

        return $this;
    }

    /**
     * Get orderAmount
     *
     * @return string 
     */
    public function getOrderAmount()
    {
        return $this->orderAmount;
    }

    /**
     * Set orderCreatedTime
     *
     * @param \DateTime $orderCreatedTime
     * @return HqtestOrder
     */
    public function setOrderCreatedTime($orderCreatedTime)
    {
        $this->orderCreatedTime = new \DateTime($orderCreatedTime);//$orderCreatedTime;

        return $this;
    }

    /**
     * Get orderCreatedTime
     *
     * @return \DateTime 
     */
    public function getOrderCreatedTime()
    {
        return $this->orderCreatedTime;
    }

    /**
     * Set transactionResponse
     *
     * @param string $transactionResponse
     * @return HqtestOrder
     */
    public function setTransactionResponse($transactionResponse)
    {
        $this->transactionResponse = $transactionResponse;

        return $this;
    }

    /**
     * Get transactionResponse
     *
     * @return string 
     */
    public function getTransactionResponse()
    {
        return $this->transactionResponse;
    }

    /**
     * Get orderId
     *
     * @return integer 
     */
    public function getOrderId()
    {
        return $this->orderId;
    }
}
