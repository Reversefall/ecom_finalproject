<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GitHubUploadService
{
    protected $token;
    protected $owner;
    protected $repo;
    protected $branch;

    public function __construct()
    {
        $this->token = config('services.github.token');
        $this->owner = config('services.github.owner');
        $this->repo = config('services.github.repo');
        $this->branch = config('services.github.branch');
    }

    public function uploadFile($file, $pathOnRepo)
    {
        $apiUrl = "https://api.github.com/repos/{$this->owner}/{$this->repo}/contents/{$pathOnRepo}";

        $base64Content = base64_encode(file_get_contents($file->getRealPath()));

        $sha = null;
        $response = Http::withToken($this->token)->get($apiUrl);

        if ($response->ok()) {
            $sha = $response->json()['sha'] ?? null;
        }

        $body = [
            'message' => 'Upload or update file ' . $file->getClientOriginalName(),
            'content' => $base64Content,
            'branch'  => $this->branch
        ];

        if ($sha) {
            $body['sha'] = $sha;
        }

        $uploadResponse = Http::withToken($this->token)->put($apiUrl, $body);

        if ($uploadResponse->failed()) {
            throw new \Exception("GitHub upload failed: " . $uploadResponse->body());
        }

        $content = $uploadResponse->json()['content'];
        $filePath = $content['path'];

        return "https://raw.githubusercontent.com/{$this->owner}/{$this->repo}/{$this->branch}/{$filePath}";
    }
}
