<?php
/**
 * @package: chapi
 *
 * @author:  msiebeneicher
 * @since:   2016-11-10
 *
 */


namespace Chapi\Service\JobValidator\PropertyValidator;

use Chapi\Entity\Chronos\JobEntity;
use Chapi\Service\JobValidator\PropertyValidatorInterface;

class Command extends AbstractPropertyValidator implements PropertyValidatorInterface
{
    const DIC_NAME = 'CommandValidator';
    const MESSAGE_TEMPLATE = '"%s" is not allowed to be empty for non docker jobs';

    /**
     * @inheritDoc
     */
    public function isValid($sProperty, JobEntity $oJobEntity)
    {
        return $this->returnIsValidHelper(
            $this->isCommandPropertyValid($oJobEntity),
            $sProperty,
            self::MESSAGE_TEMPLATE
        );
    }

    /**
     * @param JobEntity $oJobEntity
     * @return bool
     */
    private function isCommandPropertyValid(JobEntity $oJobEntity)
    {
        if (is_null($oJobEntity->container))
        {
            return (!empty($oJobEntity->command) && is_string($oJobEntity->command));
        }
        
        return (empty($oJobEntity->command) || is_string($oJobEntity->command));
    }
}