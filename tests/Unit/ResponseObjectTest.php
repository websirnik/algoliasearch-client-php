<?php

namespace Algolia\AlgoliaSearch\Tests\Unit;

use Algolia\AlgoliaSearch\Client;

class ResponseObjectTest extends RequestTestCase
{
    public function testResponseObjectIsArrayAccessible()
    {
        $response = Client::get()->addApiKey(array());
        $this->assertInstanceOf('Algolia\AlgoliaSearch\Response\AddApiKeyResponse', $response);
        $this->assertTrue(method_exists($response, 'wait'));

        $response = Client::get()->deleteApiKey('key');
        $this->assertInstanceOf('Algolia\AlgoliaSearch\Response\DeleteApiKeyResponse', $response);
        $this->assertTrue(method_exists($response, 'wait'));

        $response = Client::get()->multipleBatchObjects(array());
        $this->assertInstanceOf('Algolia\AlgoliaSearch\Response\MultipleIndexingResponse', $response);
        $this->assertTrue(method_exists($response, 'wait'));
    }

    public function testIndexingResponse()
    {
        $i = Client::get()->initIndex('cool');

        $this->assertInstanceOfIndexingResponse($i->clear());
        $this->assertInstanceOfIndexingResponse($i->setSettings(array('objectID' => 'test')));
        $this->assertInstanceOfIndexingResponse($i->saveObject(array('objectID' => 'test')));
        $this->assertInstanceOfIndexingResponse($i->saveObjects(array('objectID' => 'test')));
        $this->assertInstanceOfIndexingResponse($i->partialUpdateObject(array('objectID' => 'test')));
        $this->assertInstanceOfIndexingResponse($i->partialUpdateObjects(array('objectID' => 'test')));
        $this->assertInstanceOfIndexingResponse($i->partialUpdateOrCreateObject(array('objectID' => 'test')));
        $this->assertInstanceOfIndexingResponse($i->partialUpdateOrCreateObjects(array('objectID' => 'test')));
        $this->assertInstanceOfIndexingResponse($i->freshObjects(array('objectID' => 'test')));
        $this->assertInstanceOfIndexingResponse($i->deleteObject(array('objectID' => 'test')));
        $this->assertInstanceOfIndexingResponse($i->deleteObjects(array('objectID' => 'test')));
        $this->assertInstanceOfIndexingResponse($i->deleteBy(array('objectID' => 'test')));
        $this->assertInstanceOfIndexingResponse($i->batch(array('objectID' => 'test')));

        $this->assertInstanceOfIndexingResponse($i->saveSynonym(array('objectID' => 'test')));
        $this->assertInstanceOfIndexingResponse($i->saveSynonyms(array('objectID' => 'test')));
        $this->assertInstanceOfIndexingResponse($i->freshSynonyms(array('objectID' => 'test')));
        $this->assertInstanceOfIndexingResponse($i->deleteSynonym('objectID'));
        $this->assertInstanceOfIndexingResponse($i->clearSynonyms(array('objectID' => 'test')));

        $this->assertInstanceOfIndexingResponse($i->saveRule(array('objectID' => 'test')));
        $this->assertInstanceOfIndexingResponse($i->saveRules(array('objectID' => 'test')));
        $this->assertInstanceOfIndexingResponse($i->freshRules(array('objectID' => 'test')));
        $this->assertInstanceOfIndexingResponse($i->deleteRule('objectID'));
        $this->assertInstanceOfIndexingResponse($i->clearRules(array('objectID' => 'test')));

        $this->assertInstanceOfIndexingResponse($i->deleteDeprecatedIndexApiKey("key"));
    }

    private function assertInstanceOfIndexingResponse($response)
    {
        $this->assertInstanceOf('Algolia\AlgoliaSearch\Response\IndexingResponse', $response);
        $this->assertTrue(method_exists($response, 'wait'));
    }
}
