# PHP Open Telemetry Example

## Introduction

This is an example production deployment of this Open Telemetry Example. It uses images from GitHub Container Registry
to run the application, all you need to do is edit the configuration and bring up the docker compose project using
`docker compose up -d`.

## Application Configuration

The application is configured to listen and expose HTTP on port 8000, the intention is for this to be behind a load
load balancer. You can modify the entrypoint to pass custom parameters to Octane to listen directly on 80/443, and use
LetsEncrypt to automatically obtain certificates.

The `.env.telemetry` file contains configuration for the application. The only thing you need to set is a Laravel
application key.

## Open Telemetry Collector Configuration

This is the AWS version of the Open Telemetry Collector. If you are using AWS and want to export to CloudWatch, you can
set your AWS region and credentials in `.env.collector`.

The main configuration is in `otel-collector-config.yaml` and by default is setup to use Honeycomb and AWS. You can set
your Honeycomb API key in this file.

## License

MIT License

Copyright (c) 2025 Jessica Smith

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
