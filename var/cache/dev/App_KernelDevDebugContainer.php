<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerDfZ5Rzt\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerDfZ5Rzt/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerDfZ5Rzt.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerDfZ5Rzt\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \ContainerDfZ5Rzt\App_KernelDevDebugContainer([
    'container.build_hash' => 'DfZ5Rzt',
    'container.build_id' => '28671e1c',
    'container.build_time' => 1580760718,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerDfZ5Rzt');
