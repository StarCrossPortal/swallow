<?php
declare (strict_types = 1);

namespace app\command;

use app\model\Fortify;
use app\model\SemGrep;
use app\model\GitAddr;
use think\console\Command;
use think\console\Input;
use think\console\input\Argument;
use think\console\input\Option;
use think\console\Output;

class scan extends Command
{
    protected function configure()
    {
        // 指令配置
        $this->setName('app\command\scan')
            ->addArgument('action', Argument::OPTIONAL, "你要操作的行为")
            ->setDescription('the app\command\scan command');
    }

    protected function execute(Input $input, Output $output)
    {

        $action = trim($input->getArgument('action'));
        if ($action == 'git') {
            GitAddr::start();
        }elseif ($action == 'semgrep') {
            Semgrep::start();
        }elseif ($action == 'fortify') {
            Fortify::start();
        }
        // 指令输出
        $output->writeln('app\command\scan');
    }
}
