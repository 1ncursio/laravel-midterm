<template>
    <app-layout title="Add new post">
        <div class="heading text-center font-bold text-2xl m-5 text-gray-800">
            New Post
        </div>
        <form
            class="
                editor
                mx-auto
                w-10/12
                flex flex-col
                text-gray-800
                border border-gray-300
                p-4
                shadow-lg
                max-w-2xl
            "
            @submit.prevent="form.patch(`/subjects/${subject.id}`)"
        >
            <div class="flex gap-2 items-center">
                <input
                    class="
                        flex-1
                        title
                        bg-gray-100
                        border border-gray-300
                        p-2
                        mb-4
                        outline-none
                    "
                    v-model="form.name"
                    spellcheck="false"
                    placeholder="과목명"
                    type="text"
                />
                <span> 학점 </span>
                <input
                    class="
                        bg-gray-100
                        border border-gray-300
                        p-2
                        mb-4
                        outline-none
                    "
                    v-model="form.credit"
                    spellcheck="false"
                    placeholder="학점"
                    type="number"
                />
            </div>

            <textarea
                class="
                    description
                    bg-gray-100
                    sec
                    p-3
                    h-60
                    border border-gray-300
                    outline-none
                "
                v-model="form.description"
                spellcheck="false"
                placeholder="과목 설명"
            ></textarea>

            <!-- buttons -->
            <div class="buttons flex justify-end">
                <button
                    type="submit"
                    :disabled="form.processing"
                    class="
                        btn
                        border border-indigo-500
                        p-1
                        px-4
                        font-semibold
                        cursor-pointer
                        text-gray-200
                        ml-2
                        bg-indigo-500
                    "
                >
                    등록
                </button>
            </div>
        </form>
    </app-layout>
</template>
<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link, useForm } from "@inertiajs/inertia-vue3";
import { defineComponent, ref } from "@vue/runtime-core";

export default defineComponent({
    components: {
        AppLayout,
        Link,
    },
    props: ["subject"],
    setup(props) {
        const form = useForm({
            name: props.subject.name,
            description: props.subject.description,
            credit: props.subject.credit,
        });

        return { form };
    },
});
</script>
<style lang=""></style>
