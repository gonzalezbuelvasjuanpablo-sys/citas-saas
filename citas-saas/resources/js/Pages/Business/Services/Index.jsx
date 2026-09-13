import BusinessLayout from '../../Layouts/BusinessLayout';
import { Link, usePage, router } from '@inertiajs/react';

// Este componente recibe 'services' y 'business' como props desde Laravel
export default function ServicesIndex({ services, business }) {
    const { auth, flash } = usePage().props;

    // Esta función elimina un servicio
    // router.delete() es el equivalente de un form con method DELETE en Blade
    function handleDelete(serviceId) {
        if (confirm('¿Eliminar este servicio?')) {
            router.delete(`/business/services/${serviceId}`);
        }
    }

    return (
        <BusinessLayout business={business} user={auth.user}>

            {/* Header */}
            <div className="flex justify-between items-center mb-6">
                <div>
                    <h2 className="text-2xl font-bold text-gray-800">Servicios</h2>
                    <p className="text-gray-500">Gestiona los servicios de tu negocio</p>
                </div>
                <Link
                    href="/business/services/create"
                    className="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 font-medium"
                >
                    + Nuevo servicio
                </Link>
            </div>

            {/* Mensaje de éxito */}
            {flash?.success && (
                <div className="bg-green-100 text-green-700 px-4 py-3 rounded-lg mb-6">
                    {flash.success}
                </div>
            )}

            {/* Tabla */}
            <div className="bg-white rounded-xl shadow overflow-hidden">
                <table className="w-full text-sm">
                    <thead className="bg-gray-50">
                        <tr className="text-left text-gray-500 border-b">
                            <th className="px-6 py-4">Servicio</th>
                            <th className="px-6 py-4">Duración</th>
                            <th className="px-6 py-4">Precio</th>
                            <th className="px-6 py-4">Estado</th>
                            <th className="px-6 py-4">Acciones</th>
                        </tr>
                    </thead>
                    <tbody className="divide-y divide-gray-100">
                        {services.length === 0 ? (
                            <tr>
                                <td colSpan="5" className="px-6 py-8 text-center text-gray-400">
                                    No hay servicios registrados aún.
                                </td>
                            </tr>
                        ) : (
                            services.map(service => (
                                <tr key={service.id}>
                                    <td className="px-6 py-4">
                                        <p className="font-medium text-gray-800">{service.name}</p>
                                        <p className="text-gray-400 text-xs">{service.description}</p>
                                    </td>
                                    <td className="px-6 py-4">{service.duration_minutes} min</td>
                                    <td className="px-6 py-4">
                                        ${Number(service.price).toLocaleString('es-CO')}
                                    </td>
                                    <td className="px-6 py-4">
                                        {service.is_active ? (
                                            <span className="px-2 py-1 bg-green-100 text-green-700 rounded-full text-xs font-medium">Activo</span>
                                        ) : (
                                            <span className="px-2 py-1 bg-red-100 text-red-700 rounded-full text-xs font-medium">Inactivo</span>
                                        )}
                                    </td>
                                    <td className="px-6 py-4">
                                        <div className="flex gap-3">
                                            <Link
                                                href={`/business/services/${service.id}/edit`}
                                                className="text-indigo-600 hover:underline"
                                            >
                                                Editar
                                            </Link>
                                            <button
                                                onClick={() => handleDelete(service.id)}
                                                className="text-red-500 hover:underline"
                                            >
                                                Eliminar
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            ))
                        )}
                    </tbody>
                </table>
            </div>

        </BusinessLayout>
    );
}