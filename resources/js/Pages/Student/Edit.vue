<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
  student: Object
});

const form = useForm({
  name: props.student?.name || '',
  age: props.student?.age || '',
  status: props.student?.status || 'active',
});



const submit = () => {
    
if (!form.name) {
    form.errors.name = "Name is required";
  }

  if (!form.age) {
    form.errors.age = "Age is required";
  } else if (form.age < 1) {
    form.errors.age = "Age must be valid";
  }

  if (!form.status) {
    form.errors.status = "Status is required";
  }


  const data = new FormData();
  data.append('name', form.name);
  data.append('age', form.age);
  data.append('status', form.status);
  if (form.image) data.append('image', form.image);

  form.put(route('student.update', props.student.id), {
    onSuccess: () => form.reset(),
    preserveScroll: true,
  });
};

</script>

<template>
    <Head title="Edit" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Edit student
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
                >
                    <div class="p-6 text-gray-900">
                        
    <form @submit.prevent="submit" class="flex-col w-full gap-6">
      <div class="space-y-4">
        <!-- Name -->
        <div>
          <InputLabel for="name" value="Name" />
          <TextInput
            id="name"
            ref="name"
            v-model="form.name"
            class="mt-1 block w-full"
            placeholder="Enter student name"
          />
          <InputError :message="form.errors.name" class="mt-2" />
        </div>

        <!-- Age -->
        <div>
          <InputLabel for="age" value="Age" />
          <TextInput
            id="age"
            ref="age"
            v-model="form.age"
            type="number"
            class="mt-1 block w-full"
            placeholder="Enter age"
          />
          <InputError :message="form.errors.age" class="mt-2" />
        </div>

        <!-- Status -->
        <div>
          <InputLabel for="status" value="Status" />
          <select
            id="status"
            ref="status"
            v-model="form.status"
            class="border-gray-300 border rounded w-full mt-1 p-2"
          >
            <option value="active">
                active
            </option>
            <option value="inactive">
                inactive
            </option>
          </select>
          <InputError :message="form.errors.status" class="mt-2" />
        </div>
        
      </div>
    </form>
    
    <!-- Update Button -->
    <div class="mt-6">
      <PrimaryButton :disabled="form.processing" @click="submit">
        Update Student
      </PrimaryButton>
    </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
