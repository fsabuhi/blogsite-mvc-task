import { PlaceholderPattern } from '@/components/ui/placeholder-pattern';
import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head, usePage } from '@inertiajs/react';
import { Link, useForm } from '@inertiajs/react';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Posts',
        href: '/posts',
    },
];

export default function Posts() {
    const { props } = usePage<{ posts: { id: number; name: string; content: string; image?: string }[] }>();
    const posts = props.posts || [];
    const { delete: destroy } = useForm();

    const handleDelete = (id: number) => {
        if (confirm('Are you sure you want to delete this post?')) {
            destroy(route('posts.delete', id));
        }
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Posts" />
            <div className="flex flex-col items-center w-full h-full m-2">
                <div className="border border-gray-200 rounded-lg p-4 w-full justify-between flex items-center">
                    <h1 className="text-2xl font-bold">Posts</h1>
                    <button className="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        <Link href={route('posts.create')}>Yeni artikl</Link>
                    </button>
                </div>

                <div className="border border-gray-200 rounded-lg p-4 w-full h-full m-4">
                    {posts.length > 0 ? (
                        <ul className="space-y-4">
                         {posts.map((post) => (
    <li key={post.id} className="border-b border-gray-300 pb-2">
        <h2 className="text-lg font-semibold">{post.name}</h2>
        <p className="text-gray-600">{post.content}</p>
        {post.image && (
            <img src={post.image_url} alt={post.name} className="mt-2 max-w-full h-auto rounded" />
        )}
        <div className="mt-2 flex space-x-2">
            <button
                onClick={() => handleDelete(post.id)}
                className="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded"
            >
                Delete
            </button>
        </div>
    </li>
))}
                        </ul>
                    ) : (
                        <p className="text-gray-500">No posts available.</p>
                    )}
                </div>
            </div>
        </AppLayout>
    );
}