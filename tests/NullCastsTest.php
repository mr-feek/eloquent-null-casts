<?php

namespace MrFeek\EloquentNullCasts\Tests;

use MrFeek\EloquentNullCasts\Tests\data\FailingUser;
use MrFeek\EloquentNullCasts\Tests\data\UserWithInheritance;
use MrFeek\EloquentNullCasts\Tests\data\UserWithTrait;
use Orchestra\Testbench\TestCase;

class NullCastsTest extends TestCase
{
    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
    }

    /**
     * @test
     * @dataProvider model_class_provider
     */
    public function sometimes_you_just_want_a_dang_boolean(string $modelClass): void
    {
        $user = new $modelClass;
        $user->name = 'first';
        $user->save();
        // populate the model with database defaults
        $user->refresh();
        $this->assertSame($user->deleted, false);
    }

    /**
     * This test really demonstrates the problem being solved. Relying on attribute default values declared on the models
     * solves the problem moving forward, but doesnt fix previous data set.
     * @test
     */
    public function show_that_defaults_with_normal_casts_dont_solve_our_problem(): void
    {
        $user = new FailingUser();
        $user->name = 'first';
        $user->deleted = null;
        $user->save();
        $user->refresh();
        $this->assertNull($user->deleted);
    }

    public function model_class_provider(): array
    {
        return [
            [UserWithTrait::class],
            [UserWithInheritance::class],
        ];
    }
}
