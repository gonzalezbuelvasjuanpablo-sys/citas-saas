import { Link } from '@inertiajs/react';

// Este es el layout principal del panel del negocio
// Es como el layouts/business.blade.php pero en React
// Recibe 'children' que son los componentes hijos que se renderizan dentro

export default function BusinessLayout({ children, business, user }) {
    return (
        <div className="bg-gray-100 min-h-screen font-sans">

            {/* Navbar */}
            <nav className="bg-white shadow px-6 py-4 flex justify-between items-center">
                <h1 className="text-xl font-bold text-gray-800">
                    {business?.name ?? 'Mi Negocio'}
                </h1>
                <div className="flex items-center gap-4">
                    <span className="text-gray-600 text-sm">{user?.name}</span>
                    <Link
                        href="/logout"
                        method="post"
                        as="button"
                        className="text-sm text-red-500 hover:underline"
                    >
                        Cerrar sesión
                    </Link>
                </div>
            </nav>

            {/* Sidebar + Content */}
            <div className="flex min-h-screen">

                {/* Sidebar */}
                <aside className="w-64 bg-white shadow-sm p-6 space-y-2">
                    <Link
                        href="/business/dashboard"
                        className="block px-4 py-2 rounded-lg text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 font-medium"
                    >
                        Dashboard
                    </Link>
                    <Link
                        href="/business/appointments"
                        className="block px-4 py-2 rounded-lg text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 font-medium"
                    >
                        Citas
                    </Link>
                    <Link
                        href="/business/services"
                        className="block px-4 py-2 rounded-lg text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 font-medium"
                    >
                        Servicios
                    </Link>
                    <Link
                        href="/business/employees"
                        className="block px-4 py-2 rounded-lg text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 font-medium"
                    >
                        Empleados
                    </Link>
                </aside>

                {/* Contenido principal */}
                <main className="flex-1 p-8">
                    {children}
                </main>

            </div>
        </div>
    );
}