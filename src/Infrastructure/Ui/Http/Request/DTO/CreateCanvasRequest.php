<?php
declare(strict_types=1);

namespace Witrac\Infrastructure\Ui\Http\Request\DTO;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
use Witrac\Infrastructure\Ui\Http\Request\RequestDTO;

class CreateCanvasRequest implements RequestDTO
{
    /**
     * @Assert\NotBlank(message = "Missing request parameter 'name'")

     * @Assert\Type(
     *     type="string",
     *     message = "Invalid value of request parameter 'name'"
     * )
     */
    private $name;


    /**
     * @Assert\NotBlank(message = "Missing request parameter 'width'")

     * @Assert\Type(
     *     type="integer",
     *     message = "Invalid value of request parameter 'width'"
     * )
     */
    private $width;

    /**
     * @Assert\NotBlank(message = "Missing request parameter 'height'")

     * @Assert\Type(
     *     type="integer",
     *     message = "Invalid value of request parameter 'height'"
     * )
     */
    private $height;


    public function __construct(Request $request)
    {
        $data = \json_decode($request->getContent(), true);

        $this->name = $data['name'] ?? null;
        $this->width = $data['width'] ?? null;
        $this->height = $data['height'] ?? null;
    }


    public function getName(): string
    {
        return strtolower($this->name);
    }


    public function getWidth(): int
    {
        return $this->width;
    }

    public function getHeight(): int
    {
        return $this->height;
    }


}


