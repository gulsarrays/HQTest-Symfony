<?php

namespace HQTest\PaymentLibBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use HQTest\PaymentLibBundle\PaymentClasses\PaymentLib;
use HQTest\PaymentLibBundle\PaymentClasses\BraintreePayments;
use HQTest\PaymentLibBundle\PaymentClasses\PayPalPayments;
use HQTest\PaymentLibBundle\Entity\HqtestOrder;

require_once dirname(dirname(dirname(dirname(__DIR__)))) . '/bootstrap.php';

class PaymentController extends Controller {

    /**
     * @Route("/hqtest/")
     * @Template()
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getEntityManager();
        $connection = $em->getConnection();
        $statement = $connection->prepare("CREATE TABLE IF NOT EXISTS `hqtest_order` (
         `order_id` int(11) NOT NULL AUTO_INCREMENT,
         `customer_name` varchar(255) NOT NULL,
         `card_holder_name` varchar(255) NOT NULL,
         `card_number` varchar(20) NOT NULL,
         `card_type` varchar(25) NOT NULL,
         `card_expiry` varchar(10) NOT NULL,
         `card_cvv` varchar(4) NOT NULL,
         `payment_currency` varchar(3) NOT NULL,
         `payment_gateway` varchar(25) NOT NULL,
         `transaction_id` varchar(50) DEFAULT NULL,
         `order_status` varchar(20) DEFAULT NULL,
         `order_amount` varchar(20) DEFAULT NULL,
         `order_created_time` datetime DEFAULT NULL,
         `transaction_response` text NOT NULL,
          PRIMARY KEY (`order_id`)
        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;");
        $statement->execute();
        return $this->forward('HQTestPaymentLibBundle:Payment:orderinput');
    }

    /**
     * @Route("/hqtest/orderinput")
     * @Template()
     */
    public function orderinputAction() {
        return $this->render('HQTestPaymentLibBundle:Payment:orderinput.html.twig');
    }

    /**
     * @Route("/hqtest/orders/{ID}")
     * @Template()
     */
    public function ordersAction($ID = 0) {
        if ((int) $ID > 0) {
            $em = $this->getDoctrine()->getManager();
            $order = $em->getRepository('HQTestPaymentLibBundle:HqtestOrder')->find($ID);
            return $this->render('HQTestPaymentLibBundle:Payment:orderdetails.html.twig', array('order' => $order));
        } else {
            $em = $this->getDoctrine()->getManager();
            $orders_arr = $em->getRepository('HQTestPaymentLibBundle:HqtestOrder')->findAll();
            return $this->render('HQTestPaymentLibBundle:Payment:orders.html.twig', array('orders' => $orders_arr));
        }
    }

    /**
     * @Route("/hqtest/payment")
     * @Template()
     */
    public function paymentAction(Request $request) {
        $success = false;

        if ($request->getMethod() == 'POST') {

            $request_arr = array(
                'customer_name' => $request->get('customer_name'),
                'item_price' => $request->get('item_price'),
                'currency' => $request->get('currency'),
                'cc_name' => $request->get('cc_name'),
                'cc_type' => $request->get('cc_type'),
                'cc_number' => $request->get('cc_number'),
                'cc_expiry' => $request->get('cc_expiry'),
                'cc_ccv' => $request->get('cc_ccv')
            );

            $payment_gateway = new PaymentLib();
            $credit_card_params = $payment_gateway->collectCreditCardParemeter($request_arr);

            $payment_method = $payment_gateway->myPaymentGateway($credit_card_params['card_type'], $credit_card_params['currency']);
            if ($payment_method === 'paypal') {
                $payment_gateway_paypal = new PayPalPayments();
                $payment_response = $payment_gateway_paypal->doPaypalPayment($payment_gateway);
            } else if ($payment_method === 'braintree') {
                $payment_gateway_braintree = new BraintreePayments();
                $payment_response = $payment_gateway_braintree->doBraintreePayment($payment_gateway);
            } else {
                $payment_response = array(
                    'error' => array(
                        'title' => "Please check for one of teh following Wrong Currency/Card Selection",
                        'message' => " -Wrong Currency/Card Selection" .
                        "AMEX is possible to use only for USD" . " \n " .
                        "-Please check for order amount" . " \n " .
                        "-Please check for Credit Card Expiry"
                    )
                );
            }
        }


        if (isset($payment_response['success']) && $payment_response['success'] === true) {

            $newOrder = new HqtestOrder();
            $newOrder->setCustomerName($credit_card_params['customer_name']);
            $newOrder->setCardHolderName($credit_card_params['card_holder']);
            $newOrder->setCardNumber($credit_card_params['mask_card_number']);
            $newOrder->setCardType($credit_card_params['card_type']);
            $newOrder->setCardExpiry($credit_card_params['card_expiry']);
            $newOrder->setCardCvv($credit_card_params['card_cvv']);
            $newOrder->setPaymentCurrency($credit_card_params['currency']);
            $newOrder->setPaymentGateway($payment_method);
            $newOrder->setTransactionId($payment_response['transaction_id']);
            $newOrder->setOrderStatus($payment_response['transaction_state']);
            $newOrder->setOrderAmount($payment_response['transaction_amount']);
            $newOrder->setOrderCreatedTime($payment_response['transaction_time']);
            $newOrder->setTransactionResponse($payment_response['raw_response']);

            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($newOrder);
            $em->flush();

            return $this->redirect($this->generateUrl('hqtest_paymentlib_payment_orders'));
        } else {
            return $this->render('HQTestPaymentLibBundle:Payment:error.html.twig', array('payment_response' => $payment_response));
        }
    }

}
