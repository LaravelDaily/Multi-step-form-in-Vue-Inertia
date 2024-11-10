<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputError from '@/Components/InputError.vue';
import TextInput from '@/Components/TextInput.vue';

const props = defineProps({
	countries: Object,
	cities: Object,
})

const price = ref(0)
const currentStep = ref(1)
const form = useForm({
	step1: {
		from_country: '',
		from_city: '',
	},
	step2: {
		to_country: '',
		to_city: '',
	},
	step3: {
		adults: 0,
		children: 0,
	},
})

const submit = () => {
	form.clearErrors()
	price.value = 0
	
	form
		.transform((data) => ({
			...data,
			step: currentStep.value
		}))
		.post(route('multi-step.store'), {
			onSuccess: () => {
				if (currentStep.value < 3) {
					currentStep.value = currentStep.value + 1;
					form.clearErrors();
				} else {
					price.value = form.step3.adults * 100 + form.step3.children * 75
				}
			},
	})
}
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
                >
                    <div class="p-6 text-gray-900">
                    
	                    <div class="flex">
					        <button type="button" v-on:click="currentStep = 1" :class="[currentStep === 1 ? 'rounded-sm border border-b-0' : 'border-b']" class="cursor-pointer border-indigo-500 bg-gray-100 p-2 text-gray-700 outline-none focus:outline-none">From</button>
					        <button type="button" v-on:click="currentStep = 2" :class="[currentStep === 2 ? 'rounded-sm border border-b-0' : 'border-b']" class="cursor-pointer border-indigo-500 bg-gray-100 p-2 text-gray-700 outline-none focus:outline-none" :disabled="currentStep < 2">To</button>
					        <button type="button" v-on:click="currentStep = 3" :class="[currentStep === 3 ? 'rounded-sm border border-b-0' : 'border-b']" class="cursor-pointer border-indigo-500 bg-gray-100 p-2 text-gray-700 outline-none focus:outline-none" :disabled="currentStep < 3">Passengers</button>
					        <div class="flex-grow border-b border-indigo-500"></div>
					    </div>
	                    
	                    <form @submit.prevent="submit">
		                   <template v-if="currentStep === 1">
			                   <div class="mt-4">
				                   <InputLabel for="from-country" value="From Country" />
				                   <select id="from-country" v-model="form.step1.from_country" class="mt-2 w-52 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
					                   <option value="">--</option>
					                   <option v-for="country in props.countries" :value="country.id" :key="country.id">
						                   {{ country.name }}
					                   </option>
				                   </select>
				                   <InputError class="mt-2" :message="form.errors['step1.from_country']" />
			                   </div>

			                   <div class="mt-4">
				                   <InputLabel for="from-city" value="From City" />
				                   <select id="from-city" v-model="form.step1.from_city" class="mt-2 w-52 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
					                   <option value="">--</option>
					                   <option v-for="city in props.cities[form.step1.from_country]" :value="city.id" :key="city.id">
						                   {{ city.name }}
					                   </option>
				                   </select>
				                   <InputError class="mt-2" :message="form.errors['step1.from_city']" />
			                   </div>
		                   </template>
		                   
		                   <template v-if="currentStep === 2">
			                   <div class="mt-4">
				                   <InputLabel for="to-country" value="To Country" />
				                   <select id="to-country" v-model="form.step2.to_country" class="mt-2 w-52 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
					                   <option value="">--</option>
					                   <option v-for="country in props.countries" :value="country.id" :key="country.id">
						                   {{ country.name }}
					                   </option>
				                   </select>
				                   <InputError class="mt-2" :message="form.errors['step2.to_country']" />
			                   </div>
				                  
			                   <div class="mt-4">
				                   <InputLabel for="to-city" value="To City" />
				                   <select id="to-city" v-model="form.step2.to_city" class="mt-2 w-52 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
					                   <option value="">--</option>
					                   <option v-for="city in props.cities[form.step2.to_country]" :value="city.id" :key="city.id">
						                   {{ city.name }}
					                   </option>
				                   </select>
				                   <InputError class="mt-2" :message="form.errors['step2.to_city']" />
			                   </div>
		                   </template>
		                   
		                   <template v-if="currentStep === 3">
			                   <div class="mt-4">
				                   <InputLabel for="adults-number" value="Adults" />
				                   <TextInput v-model="form.step3.adults" id="adults-number" type="number" />
				                   <InputError class="mt-2" :message="form.errors['step3.adults']" />
			                   </div>
				                  
			                   <div class="mt-4">
				                   <InputLabel for="children-number" value="Children" />
				                   <TextInput v-model="form.step3.children" id="children-number" type="number" />
				                   <InputError class="mt-2" :message="form.errors['step3.children']" />
			                   </div>
			                   
			                   <div class="mt-4" v-show="price">
				                   Price: <span class="font-bold">{{ price }}</span>
			                   </div>
		                   </template>
		                    
		                    <primary-button class="mt-4">
			                    {{ currentStep < 3 ? 'Next' : 'Submit' }}
		                    </primary-button>
	                    </form>
	                   
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
