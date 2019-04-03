<?php
namespace BelodubrovskyiAn\AskQuestion\Controller\Submit;

use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Exception\LocalizedException;
use BelodubrovskyiAn\AskQuestion\Api\Data\AskQuestionInterface;
use BelodubrovskyiAn\AskQuestion\Api\AskQuestionRepositoryInterface;
use BelodubrovskyiAn\AskQuestion\Helper\Mail;

/**
 * Class Index
 * @package BelodubrovskyiAn\AskQuestion\Controller\Submit
 */
class Index extends \Magento\Framework\App\Action\Action
{
    const STATUS_ERROR = 'Error';
    const STATUS_SUCCESS = 'Success';

    /**
     * @var \Magento\Framework\Data\Form\FormKey\Validator
     */
    private $formKeyValidator;

    /**
     * @var Mail
     */
    private $mailHelper;

    /**
     * @var \BelodubrovskyiAn\AskQuestion\Model\AskQuestionFactory
     */
    private $askQuestionFactory;

    /**
     * @var AskQuestionRepositoryInterface
     */
    private $askQuestionRepository;

    /**
     * Index constructor.
     * @param \Magento\Framework\Data\Form\FormKey\Validator $formKeyValidator
     * @param \Magento\Framework\App\Action\Context $context
     * @param \BelodubrovskyiAn\AskQuestion\Model\AskQuestionFactory $askQuestionFactory
     * @param Mail $mailHelper
     */
    public function __construct(
        \Magento\Framework\Data\Form\FormKey\Validator $formKeyValidator,
        \Magento\Framework\App\Action\Context $context,
        \BelodubrovskyiAn\AskQuestion\Model\AskQuestionFactory $askQuestionFactory,
        Mail $mailHelper,
        AskQuestionRepositoryInterface $askQuestionRepository
    ) {
        parent::__construct($context);
        $this->formKeyValidator = $formKeyValidator;
        $this->askQuestionFactory =$askQuestionFactory;
        $this->mailHelper = $mailHelper;
        $this->askQuestionRepository = $askQuestionRepository;
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Json|\Magento\Framework\Controller\ResultInterface
     * @throws \Exception
     */
    public function execute()
    {
        $request = $this->getRequest();
        try {
            if (!$this->formKeyValidator->validate($request) || $request->getParam('hideit')) {
                throw new LocalizedException(__('Something went wrong. Probably you were away for quite a long
                 time already. Please, reload the page and try again.'));
            }
            // Here we must also process backend validation or all form fields.
            // Otherwise attackers can just copy our page, remove fields validation and send anything they want
            /** @var AskQuestionInterface $askQuestion */
            $askQuestion = $this->askQuestionFactory->create();
            $askQuestion->setName($request->getParam('name'))
                ->setEmail($request->getParam('email'))
                ->setPhone($request->getParam('phone'))
                ->setProductName($request->getParam('product_name'))
                ->setSku($request->getParam('sku'))
                ->setQuestion($request->getParam('question'));
            $this->askQuestionRepository->save($askQuestion);

            /**
             * Send Email
             */
            if ($request->getParam('email')) {
                $email = $request->getParam('email');
                $customerName = $request->getParam('name');
                $product = $request->getParam('product_name');
                $sku = $request->getParam('sku');
                $message = $request->getParam('question');
                $this->mailHelper->sendMail($email, $customerName, $message, $product, $sku);
            }

            $data = [
                'status' => self::STATUS_SUCCESS,
                'message' => __('Your request was submitted. We\'ll get in touch with you as soon as possible.')
            ];
            if ($this->mailHelper->getEnableFlagEmailing() == 0) {
                throw new LocalizedException(__('EMailing disabled.'));
            }
        } catch (LocalizedException $e) {
            $data = [
                'status'  => self::STATUS_ERROR,
                'message' => $e->getMessage()
            ];
        }
        /**
         * @var \Magento\Framework\Controller\Result\Json $controllerResult
         */
        $controllerResult = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        return $controllerResult->setData($data);
    }
}
