<?php

namespace Flexsim\WebserverSDK;

class RequestHandler
{
    protected $guzzleClient;

    public function __construct($webserverClient)
    {
        $uri = \substr($webserverClient->getBaseURI(), 0, \strpos($webserverClient->getBaseURI(), 'webserver.dll'));

        $this->guzzleClient = new \GuzzleHttp\Client([
            'base_uri' => $uri
        ]);
    }

    protected function sendRequest($queryParameters)
    {
        return $this->guzzleClients->get('webserver.dll', $queryParameters);
    }

    public function availableModels()
    {
        return $this->sendRequest([
            'query' => ['availablemodels']
        ]);
    }

    public function allFiles()
    {
        return $this->sendRequest([
            'query' => ['allfiles']
        ]);
    }

    public function configuration()
    {
        return $this->sendRequest([
            'query' => ['configuration']
        ]);
    }

    // public function uploadModel($model)
    // {
    //     return $this->sendRequest([
    //         'query' => ['uploadmodel']
    //     ]);
    // }

    public function deleteModel($modelName)
    {
        return $this->sendRequest([
            'query' => ['deletemodel' => $modelName]
        ]);
    }

    // public function downloadfile($fileName)
    // {
    //     return $this->sendRequest([
    //         'query' => ['downloadfile' => $fileName]
    //     ]);
    // }

    public function instanceList()
    {
        return $this->sendRequest([
            'query' => ['instancelist']
        ]);
    }

    public function numInstances()
    {
        return $this->sendRequest([
            'query' => ['numinstances']
        ]);
    }

    public function createInstance($modelName)
    {
        return $this->sendRequest([
            'query' => ['createinstance' => $modelName]
        ]);
    }

    public function queryInstance($modelName, $instanceNum)
    {
        return $this->sendRequest([
            'query' => [
                'queryinstance' => $modelName,
                'instancenum' => $instanceNum
            ]
        ]);
    }

    public function terminateInstance($modelName, $instanceNum)
    {
        return $this->sendRequest([
            'query' => [
                'terminateinstance' => $modelName,
                'instancenum' => $instanceNum
            ]
        ]);
    }

    public function getLibraries()
    {
        return $this->sendRequest([
            'query' => ['getlibraries']
        ]);
    }

    public function getModules()
    {
        return $this->sendRequest([
            'query' => ['getmodules']
        ]);
    }

    // public function submitJob($jobData)
    // {
    //     return $this->sendRequest([
    //         'query' => ['submitjob']
    //     ]);
    // }

    // public function getJobQuery($jobId)
    // {
    //     return $this->sendRequest([
    //         'query' => ['getjobquery' => $jobId]
    //     ]);
    // }

    // public function getJobResults($jobId)
    // {
    //     return $this->sendRequest([
    //         'query' => ['getjobresults' => $jobId]
    //     ]);
    // }

    // public function getJobStatus($jobId)
    // {
    //     return $this->sendRequest([
    //         'query' => ['getjobstatus' => $jobId]
    //     ]);
    // }

    // public function getjobqueuelength()
    // {
    //     return $this->sendRequest([
    //         'query' => ['getjobqueuelength']
    //     ]);
    // }

    // public function cancelJob($jobId)
    // {
    //     return $this->sendRequest([
    //         'query' => ['availablemodels' => $jobId]
    //     ]);
    // }
}
