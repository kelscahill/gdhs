<?php

namespace WPForms\Vendor\Box\Spout\Common\Creator;

use WPForms\Vendor\Box\Spout\Common\Helper\EncodingHelper;
use WPForms\Vendor\Box\Spout\Common\Helper\FileSystemHelper;
use WPForms\Vendor\Box\Spout\Common\Helper\GlobalFunctionsHelper;
use WPForms\Vendor\Box\Spout\Common\Helper\StringHelper;
/**
 * Class HelperFactory
 * Factory to create helpers
 */
class HelperFactory
{
    /**
     * @return GlobalFunctionsHelper
     */
    public function createGlobalFunctionsHelper()
    {
        return new GlobalFunctionsHelper();
    }
    /**
     * @param string $baseFolderPath The path of the base folder where all the I/O can occur
     * @return FileSystemHelper
     */
    public function createFileSystemHelper($baseFolderPath)
    {
        return new FileSystemHelper($baseFolderPath);
    }
    /**
     * @param GlobalFunctionsHelper $globalFunctionsHelper
     * @return EncodingHelper
     */
    public function createEncodingHelper(GlobalFunctionsHelper $globalFunctionsHelper)
    {
        return new EncodingHelper($globalFunctionsHelper);
    }
    /**
     * @return StringHelper
     */
    public function createStringHelper()
    {
        return new StringHelper();
    }
}
