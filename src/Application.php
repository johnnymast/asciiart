<?php

namespace JM\ASCII;

use League\CLImate\Exceptions\InvalidArgumentException;
use JM\ASCII\Exceptions\NoSuchFileException;
use JM\ASCII\Factories\ImageFactory;
use League\CLImate\CLImate;

class Application
{

    public function __construct()
    {
        $this->cli = new CLImate;
        $this->setupArguments();
    }

    private function setupArguments()
    {
        $this->cli->arguments->add(
          [
            'filename' => [
              'prefix' => 'f',
              'longPrefix' => 'file',
              'description' => 'The file to convert into ASCII art.',
              'required' => true,
            ],
            'width' => [
              'prefix' => 'w',
              'longPrefix' => 'width',
              'description' => 'Target output Width',
              'castTo' => 'int',
            ],
            'height' => [
              'prefix' => 'h',
              'longPrefix' => 'height',
              'description' => 'Target output height',
              'castTo' => 'int',
            ],
            'help' => [
              'longPrefix' => 'help',
              'description' => 'Prints a usage statement',
              'noValue' => true,
            ],
          ]
        );
    }

    public function run()
    {
        try {
            $this->cli->arguments->parse();

            if ($this->cli->arguments->get('help')) {
                $this->cli->usage();
                return;
            }

            $image = ImageFactory::create(
              new Settings(
                [
                  'source_file' => $this->cli->arguments->get('filename'),
                  'target_width' => $this->cli->arguments->get('width', 0),
                  'target_height' => $this->cli->arguments->get('height', 0)
                ]
              )
            );

            Generator::output($image);


        } catch (NoSuchFileException $e) {
            $this->cli->out($e->getMessage());
        } catch (\InvalidArgumentException $e) {
            $this->cli->usage();
        }
    }
}