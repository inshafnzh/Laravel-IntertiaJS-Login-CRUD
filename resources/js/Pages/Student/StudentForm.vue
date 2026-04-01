<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    image: '',
    status: 'active',
    age: '',
});

// Handle image selection
const handleImage = (event) => {
  const file = event.target.files[0];
  if (file) {
    form.image = file;
  }
};

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

  form.post(route('student.store'), {
    onSuccess: () => form.reset(),
    preserveScroll: true,
  });
};

</script>

<template>
    <h2 class="text-2xl font-semibold mb-6">Add New Student</h2>

    <form @submit.prevent="submit" class="flex-column w-full gap-6">
      <!-- Left Section -->
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
            <option value="active" selected>
                active
            </option>
            <option value="inactive">
                inactive
            </option>
          </select>
          <InputError :message="form.errors.status" class="mt-2" />
        </div>
        <div>
        <InputLabel for="image" value="Profile image" />
        <input 
        type="file"
        id="image"
        ref="image" 
        @change="handleImage" 
        accept="image/*"
        class="border-gray-300 border rounded w-full mt-1 p-2" />
        </div>
      </div>
    </form>
    
    <!-- Submit Button -->
    <div class="mt-6">
      <PrimaryButton :disabled="form.processing" @click="submit">
        Save Student
      </PrimaryButton>
    </div>
</template>