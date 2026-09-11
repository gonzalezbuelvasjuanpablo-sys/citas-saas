import BusinessLayout from '../Layouts/BusinessLayout';
import { usePage } from '@inertiajs/react';

export default function Dashboard({ stats, upcoming_appointments, business }) {

    const { auth } = usePage().props;

    const statusLabels = {
        pending:   'Pendiente',
        confirmed: 'Confirmada',
        completed: 'Completada',
        cancelled: 'Cancelada',
        no_show:   'No asistió',
    };

    const statusColors = {
        pending:   'bg-yellow-100 text-yellow-700',
        confirmed: 'bg-green-100 text-green-700',
        completed: 'bg-blue-100 text-blue-700',
        cancelled: 'bg-red-100 text-red-700',
        no_show:   'bg-gray-100 text-gray-700',
    };

    return (
        <BusinessLayout business={business} user={auth.user}>

            {/* Título */}
            <div className="mb-6">
                <h2 className="text-2xl font-bold text-gray-800">Dashboard</h2>
                <p className="text-gray-500">Bienvenido, {auth.user.name}</p>
            </div>

            {/* Link de reservas */}
            <div className="bg-indigo-50 border border-indigo-200 rounded-xl px-6 py-4 mb-6 flex items-center justify-between">
                <div>
                    <p className="text-sm font-medium text-indigo-700">Tu link de reservas</p>
                    <p className="text-indigo-600 font-mono text-sm mt-1">
                        {window.location.origin}/book/{business.slug}
                    </p>
                </div>
                
                <a
                    href={`/book/${business.slug}`}
                    target="_blank"
                    className="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-indigo-700"
                >
                    Ver página
                </a>
            </div>

            {/* Estadísticas */}
            <div className="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div className="bg-white rounded-xl shadow p-6">
                    <p className="text-sm text-gray-500">Citas hoy</p>
                    <p className="text-3xl font-bold text-indigo-600">{stats.total_appointments_today}</p>
                </div>
                <div className="bg-white rounded-xl shadow p-6">
                    <p className="text-sm text-gray-500">Citas este mes</p>
                    <p className="text-3xl font-bold text-indigo-600">{stats.total_appointments_month}</p>
                </div>
                <div className="bg-white rounded-xl shadow p-6">
                    <p className="text-sm text-gray-500">Clientes</p>
                    <p className="text-3xl font-bold text-indigo-600">{stats.total_clients}</p>
                </div>
                <div className="bg-white rounded-xl shadow p-6">
                    <p className="text-sm text-gray-500">Servicios</p>
                    <p className="text-3xl font-bold text-indigo-600">{stats.total_services}</p>
                </div>
            </div>

            {/* Próximas citas */}
            <div className="bg-white rounded-xl shadow p-6">
                <h3 className="text-lg font-bold text-gray-800 mb-4">Próximas citas</h3>

                {upcoming_appointments.length === 0 ? (
                    <p className="text-gray-400">No hay citas próximas.</p>
                ) : (
                    <table className="w-full text-sm">
                        <thead>
                            <tr className="text-left text-gray-500 border-b">
                                <th className="pb-3">Cliente</th>
                                <th className="pb-3">Servicio</th>
                                <th className="pb-3">Empleado</th>
                                <th className="pb-3">Fecha y hora</th>
                                <th className="pb-3">Estado</th>
                            </tr>
                        </thead>
                        <tbody className="divide-y divide-gray-100">
                            {upcoming_appointments.map(appointment => (
                                <tr key={appointment.id}>
                                    <td className="py-3">{appointment.client.name}</td>
                                    <td className="py-3">{appointment.service.name}</td>
                                    <td className="py-3">{appointment.employee.user.name}</td>
                                    <td className="py-3">
                                        {new Date(appointment.starts_at).toLocaleString('es-CO', {
                                            day: '2-digit', month: '2-digit', year: 'numeric',
                                            hour: '2-digit', minute: '2-digit'
                                        })}
                                    </td>
                                    <td className="py-3">
                                        <span className={`px-2 py-1 rounded-full text-xs font-medium ${statusColors[appointment.status]}`}>
                                            {statusLabels[appointment.status]}
                                        </span>
                                    </td>
                                </tr>
                            ))}
                        </tbody>
                    </table>
                )}
            </div>

        </BusinessLayout>
    );
}