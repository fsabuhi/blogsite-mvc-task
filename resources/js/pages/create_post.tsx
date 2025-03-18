import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head, useForm } from '@inertiajs/react';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Posts',
        href: '/posts',
    },
    {
        title: 'Create Post',
        href: '/posts/create',
    },
];

export default function CreatePost() {
    const { data, setData, post, processing, errors } = useForm({
        name: '',
        content: '',
        image: null,
    });

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        post('/posts/create', {
            forceFormData: true, 
        });
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Create Post" />
            <div className="flex flex-col items-center w-full h-full m-2">
                <div className="border border-gray-200 rounded-lg p-6 w-full max-w-lg">
                    <h1 className="text-2xl font-bold mb-4">Create Post</h1>
                    <form onSubmit={handleSubmit} className="flex flex-col space-y-4">
                        <div>
                            <input
                                id="name"
                                type="text"
                                value={data.name}
                                onChange={(e) => setData('name', e.target.value)}
                                placeholder="Ad"
                                className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm h-10 border border-white"
                            />
                            {errors.name && <p className="text-red-500 text-sm mt-1">{errors.name}</p>}
                        </div>
                        <div>
                            <textarea
                                id="content"
                                value={data.content}
                                placeholder="Kontent"
                                onChange={(e) => setData('content', e.target.value)}
                                className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm border border-white"
                                rows={4}
                            />
                            {errors.content && <p className="text-red-500 text-sm mt-1">{errors.content}</p>}
                        </div>
                        <div>
                            <label htmlFor="image" className="block text-sm font-medium text-gray-700">
                                Şəkil yüklə
                            </label>
                            <input
                                id="image"
                                type="file"
                                onChange={(e) => setData('image', e.target.files?.[0] || null)}
                                className="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border file:border-gray-300 file:text-sm file:font-semibold file:bg-gray-50 file:text-gray-700 hover:file:bg-gray-100"
                            />
                            {errors.image && <p className="text-red-500 text-sm mt-1">{errors.image}</p>}
                        </div>
                        <button
                            type="submit"
                            disabled={processing}
                            className="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded disabled:opacity-50"
                        >
                            {processing ? 'Yüklənir' : 'Yüklə'}
                        </button>
                    </form>
                </div>
            </div>
        </AppLayout>
    );
}