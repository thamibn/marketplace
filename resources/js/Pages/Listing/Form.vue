<script setup>
import {Head, useForm, Link} from '@inertiajs/vue3';
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {onMounted, ref, watch} from "vue";
import Checkbox from "@/Components/Checkbox.vue";
import {ElMessage} from "element-plus";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";

const props = defineProps({
    model: {
        type: Object,
        required: true,
    }
})

const roleOptions = props.model.roles.map((role, idx) => ({
    value: role,
    label: `${role.display_name}`,
}))

const supplierOptions = props.model.suppliers.map((supplier, idx) => ({
    value: supplier,
    label: `${supplier.code} - ${supplier.name}`,
}))

const selectedRoleObject = ref({});
const form = useForm({
    name: '',
    email: '',
    password: 'NEEDS_TO_CREATE_PASSWORD',
    role_id: '',
    permission_ids: [],
    supplier_ids: [],
});

onMounted(() => {

    if (!props.model.user) {
        return;
    }

    form.id = props.model.user.id
    form.uuid = props.model.user.uuid
    form.name = props.model.user.name
    form.email = props.model.user.email
    form.role_id = props.model.user.roles[0]['id']
    form.permission_ids = props.model.user.permissions.map(permission => permission.id)
    form.supplier_ids = props.model.user.suppliers.map(supplier => supplier.id)
})
const onFormSubmit = () => {
    if (props.model.user) {
        form.transform((data) => ({
            ...data,
            'id': props.model.user.id,
            'uuid': props.model.user.uuid,
        })).put(`/users/${props.model.user.id}`)
    } else {
        form.post(route('users.store'))
    }
}

watch(() => form.role_id, selectRoles => {
    console.log(selectRoles);
    if (selectRoles) {
        let roleObject = props.model.roles.filter(r => r.id === selectRoles)[0]
        selectedRoleObject.value = roleObject;
        if (roleObject.permissions.length) {
            form.permission_ids = roleObject.permissions.map(permission => permission.id)
        }
    }else{
        form.permission_ids = []
    }
})

const permissionChange = () => {
    let roleObject = props.model.roles.filter(r => r.name === 'user-defined')[0]
    if (roleObject) {
        if(form.role_id === roleObject.id){
            return
        }
        form.role_id = roleObject.id
        ElMessage.closeAll();
        ElMessage({
            message: 'Role has been changed to user defined role.',
            type: 'warning',
        })
    }
}

</script>
<template>
    <Head title="User Form"/>

    <AuthenticatedLayout>
        <div class="space-y-4">
            <div class="p-4 text-gray-600 text-base font-semibold text-2xl bg-white rounded-lg">
                User {{ props.model.user ? 'Update' : 'Create' }}
            </div>
            <div class="p-4 text-gray-600 bg-white rounded-lg">
                <form @submit.prevent="onFormSubmit" class="mt-6">
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <InputLabel for="name" value="Name"/>
                            <TextInput
                                id="name"
                                type="text"
                                class="block w-full"
                                v-model="form.name"
                                required
                                autofocus
                                autocomplete="name"
                            />
                            <InputError class="mt-2" :message="form.errors.name"/>
                        </div>

                        <div>
                            <InputLabel for="email" value="E-mail"/>
                            <TextInput
                                id="email"
                                type="email"
                                class="block w-full"
                                v-model="form.email"
                                required
                                autocomplete="email"
                            />
                            <InputError class="mt-2" :message="form.errors.email"/>
                        </div>

                        <div>
                            <InputLabel value="Role"/>
                            <el-select-v2
                                class="w-full"
                                v-model="form.role_id"
                                :options="roleOptions"
                                filterable
                                :multiple-limit="1"
                                value-key="value.id"
                            />
                            <InputError class="mt-2" :message="form.errors.role_id"/>
                        </div>
                        <div v-if="selectedRoleObject.name != 'system-admin' && selectedRoleObject.name != 'siyanda-admin'">
                            <InputLabel value="Suppliers"/>
                            <el-select-v2
                                class="w-full"
                                v-model="form.supplier_ids"
                                :options="supplierOptions"
                                filterable
                                multiple
                                :reserve-keyword="false"
                                collapse-tags
                                collapse-tags-tooltip
                                value-key="value.id"
                            />
                            <InputError class="mt-2" :message="form.errors.supplier_ids"/>
                        </div>
                    </div>

                    <h3 class="mt-6 text-gray-700 text-lg">Permissions</h3> <InputError class="mt-2" :message="form.errors.permission_ids"/>
                    <div class="grid grid-cols-4 mt-1">
                        <div class="flex items-center" v-for="(permission, index) in props.model.permissions"
                             :key="permission.id">
                            <Checkbox :name="permission.name" v-model:checked="form.permission_ids"
                                      :value="permission.id" @change="permissionChange"/>
                            <label :for="permission.name" class="pl-3 font-light text-sm text-gray-900">
                                {{ permission.display_name }}
                            </label>
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-6 space-x-4">
                        <div>
                            <ResponsiveNavLink :href="route('users.index')" class="!bg-red-600 rounded-md text-white hover:!bg-black">Cancel</ResponsiveNavLink>
                        </div>
                        <div>
                            <PrimaryButton :disabled="form.processing">{{ props.model.user ? 'Update' : 'Create' }}
                                User
                            </PrimaryButton>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
