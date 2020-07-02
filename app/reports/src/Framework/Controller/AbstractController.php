<?php /** @noinspection PhpDeprecationInspection */

namespace App\Framework\Controller;

use App\Domain\Exception\ValidationException;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use function count;

class AbstractController extends Controller
{

    protected $validatorInterface;

    protected function validateRequest($entity)
    {

        $errors = $this->validatorInterface->validate($entity);

        if (count($errors)) {
            try {
                throw new ValidationException(iterator_to_array($errors));
            }catch (Exception $e) {}
        }

    }
}
