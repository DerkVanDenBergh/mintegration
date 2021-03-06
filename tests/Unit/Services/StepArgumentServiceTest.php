<?php

namespace Tests\Unit\Services;

use Tests\TestCase;

use App\Services\StepArgumentService;
use App\Services\LogService;

use App\Models\Role;
use App\Models\StepArgument;
use App\Models\Processable;
use App\Models\User;
use App\Models\StepFunction;
use App\Models\StepFunctionParameter;
use App\Models\Step;

use PDOException; 

class StepArgumentServiceTest extends TestCase
{
    protected $stepArgumentService;

    protected $faker;
    
    protected $processable;
    protected $role;
    protected $user;
    protected $stepFunction;
    protected $step;
    protected $parameter;

    protected function setUp(): void
    {
        // Create app
        parent::setUp();

        // Create needed services
        $this->stepArgumentService = new StepArgumentService(new LogService());

        // Set up faker
        $this->faker = \Faker\Factory::create();

        // Manually create related objects if needed
        $this->role = new Role([
            'title' => 'User', 
            'can_manage_users' => true,
            'can_manage_functions' => true,
            'can_manage_roles' => true,
            'can_manage_templates' => true
        ]);

        $this->role->save();

        $this->user = new User([
            'name' => $this->faker->name, 
            'email' => $this->faker->email,
            'password' => $this->faker->text,
            'role_id' => $this->role->id
        ]);

        $this->user->save();

        $this->processable = new Processable([
            'title' => $this->faker->text,
            'description' => $this->faker->text,
            'type_id' => Processable::ROUTE,
            'active' => true,
            'slug' => $this->faker->text,
            'user_id' => $this->user->id
        ]);
        
        $this->processable->save();

        $this->stepFunction = new StepFunction([
            'name' => $this->faker->text,
            'description' => $this->faker->text,
            'function_name' => $this->faker->text,
            'has_return_value' => true
        ]);
        $this->stepFunction->save(); 

        $this->step = new Step([
            'processable_id' => $this->processable->id,
            'name' => $this->faker->text,
            'step_function_id' => $this->stepFunction->id,
            'order' => 1
        ]);

        $this->step->save();

        $this->parameter = new StepFunctionParameter([
            'name' => $this->faker->text,
            'parameter_name' => 'text_var',
            'data_type' => 'integer',
            'step_function_id' => $this->stepFunction->id,
            'is_nullable' => false
        ]);

        $this->parameter->save();
    }

    protected function tearDown(): void
    {
        $this->processable->delete();
        $this->stepFunction->delete();
        $this->step->delete();
        $this->parameter->delete();
        $this->role->delete();
        $this->user->delete();

        parent::tearDown();
    }

    public function test_validStepArgumentDataShouldResultInStoredStepArgument()
    {
        $stepArgument = $this->createTestEntity();

        $this->stepArgumentService->delete($stepArgument);
    }

    public function test_badStepArgumentDataShouldNotResultInStoredStepArgument()
    {
        $this->expectException(PDOException::class);
        
        $stepArgument = $this->createTestEntity(null, null, null, null);
    }

    public function test_validStepArgumentDataShouldResultInUpdatedStepArgument()
    {
        $stepArgument = $this->createTestEntity();

        $stepArgument = $this->stepArgumentService->update([
            'value' => 'test_update'
        ], $stepArgument);

        $this->assertTrue($stepArgument->value == 'test_update');

        $this->stepArgumentService->delete($stepArgument);
    }

    public function test_badStepArgumentDataShouldNotResultInUpdatedStepArgument()
    {
        $this->expectException(PDOException::class);

        $stepArgument = $this->createTestEntity();
        
        $stepArgument = $this->stepArgumentService->update([
            'parameter_id' => null
        ], $stepArgument);
    }

    public function test_validStepArgumentIdShouldResultInDeletedStepArgument()
    {
        $stepArgument = $this->createTestEntity();

        $id = $stepArgument->id;

        $this->stepArgumentService->delete($stepArgument);

        $this->assertTrue($this->stepArgumentService->findById($id) == null);
    }

    public function test_validStepIdShouldResultInFoundStepArgumentsFromStep()
    {
        $stepArguments = [
            $this->createTestEntity(),
            $this->createTestEntity(),
            $this->createTestEntity(),
            $this->createTestEntity(),
            $this->createTestEntity()
        ];

        $this->assertTrue($this->stepArgumentService->findAllFromStep($this->step->id)->count() == 5);

        foreach($stepArguments as $stepArgument) {
            $this->stepArgumentService->delete($stepArgument);
        }
    }

    public function test_validIdShouldResultInFoundStepArgument()
    {
        $stepArgument = $this->createTestEntity();

        $this->assertTrue($this->stepArgumentService->findById($stepArgument->id)->value == $stepArgument->value);

        $this->stepArgumentService->delete($stepArgument);
    }

    public function test_badIdShouldResultInNull()
    {
        $this->assertTrue($this->stepArgumentService->findById(9999999999) == null);
    }

    public function test_callToFindAllShouldResultInMultipleStepArguments()
    {
        $stepArguments = [
            $this->createTestEntity(),
            $this->createTestEntity(),
            $this->createTestEntity(),
            $this->createTestEntity()
        ];

        $this->assertTrue($this->stepArgumentService->findAll()->count() >= 4);

        foreach($stepArguments as $stepArgument) {
            $this->stepArgumentService->delete($stepArgument);
        }
    }

    private function createTestEntity($value = 'generate', $step = 'generate', $parameter = 'generate')
    {
        // Fill arguments with random data if they are empty
        $value = ($value == 'generate') ? $this->faker->text : $value;
        $step = ($step == 'generate') ? $this->step->id : $step;
        $parameter = ($parameter == 'generate') ? $this->parameter->id : $parameter;

        
        $stepArgument = $this->stepArgumentService->store([
            'value' => $value,
            'step_id' => $step,
            'parameter_id' => $parameter
        ]);

        $this->assertTrue($stepArgument->value == $value);
        $this->assertTrue($stepArgument->step_id == $step);
        $this->assertTrue($stepArgument->parameter_id == $parameter);

        return $stepArgument;
    }
}
