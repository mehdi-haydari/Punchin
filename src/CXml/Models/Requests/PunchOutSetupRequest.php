<?php

namespace CXml\Models\Requests;

class PunchOutSetupRequest implements RequestInterface
{
    /** @var string|null */
    private $operation;

    /** @var string|null */
    private $buyerCookie;

    /** @var string|null */
    private $browserFormPostUrl;

	private $userEmail;

	private $poomUrl;

    /** @noinspection PhpUndefinedFieldInspection */
    public function parse(\SimpleXMLElement $requestNode): void
    {
        $this->operation = (string)$requestNode->attributes()->operation;
        $this->buyerCookie = $requestNode->xpath('BuyerCookie')[0];

		foreach($requestNode->xpath('Extrinsic') as $extrinsic) {
			switch ($extrinsic->attributes()->name) {
				case 'UserEmail':
					$this->userEmail = $extrinsic->__toString();
					break;
				case 'PoomUrl';
					$this->poomUrl = $extrinsic->__toString();
					break;
			}
		}

		$this->browserFormPostUrl = count($requestNode->xpath('BrowserFormPost/URL'))
			? $requestNode->xpath('BrowserFormPost/URL')[0]
			: null;
    }

    public function getOperation(): ?string
    {
        return $this->operation;
    }

    public function setOperation(?string $operation): self
    {
        $this->operation = $operation;
        return $this;
    }

    public function getBuyerCookie(): ?string
    {
        return $this->buyerCookie;
    }

    public function setBuyerCookie(?string $buyerCookie): self
    {
        $this->buyerCookie = $buyerCookie;
        return $this;
    }

    public function getBrowserFormPostUrl(): ?string
    {
        return $this->browserFormPostUrl;
    }

    public function setBrowserFormPostUrl(?string $browserFormPostUrl): self
    {
        $this->browserFormPostUrl = $browserFormPostUrl;
        return $this;
    }
}
