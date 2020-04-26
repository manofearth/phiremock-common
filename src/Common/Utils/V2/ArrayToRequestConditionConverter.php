<?php

namespace Mcustiel\Phiremock\Common\Utils\V2;

use Mcustiel\Phiremock\Common\Utils\ArrayToRequestConditionConverter as ArrayToRequestConditionConverterV1;
use Mcustiel\Phiremock\Domain\Condition\Conditions\MethodCondition;
use Mcustiel\Phiremock\Domain\Condition\Matchers\CaseInsensitiveEquals;
use Mcustiel\Phiremock\Domain\Condition\StringValue;

class ArrayToRequestConditionConverter extends ArrayToRequestConditionConverterV1
{
    protected function convertMethodCondition(array $requestArray): ?MethodCondition
    {
        if (!empty($requestArray['method'])) {
            $method = $requestArray['method'];
            if (!\is_array($method)) {
                throw new \InvalidArgumentException('Method condition is invalid: ' . var_export($method, true));
            }

            return new MethodCondition(
                new CaseInsensitiveEquals(key($method)),
                new StringValue(current($method))
            );
        }

        return null;
    }
}
