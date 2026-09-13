import BusinessLayout from '../../Layouts/BusinessLayout';
import { useForm, usePage } from '@inertiajs/react';
import { Link } from '@inertiajs/react';

// La diferencia con Create es que useForm recibe los datos existentes del servicio
// Así los campos aparecen pre-llenados con la información actual

export default function ServicesEdit({ business, service }) {
    const { auth } = usePage().props;

    // useForm inicializa con los datos actuales del servicio
    const { data, setData, put, processing, errors } = useForm({
        name:             service.name,
        description:      service.description ?? '',
        duration_minutes: service.duration_minutes,
        price:            service.price,
        is_active:        service.is_active,
    });

    function handleSubmit(e) {
        e.preventDefault();
        // put() hace un PUT a la URL indicada
        put(`/business/services/${service.id}`);
    }

    return (
        <BusinessLayout business={business} user={auth.user}>

            <div className="mb-6">
                <h2 className="text-2xl font-bold text-gray-800">Editar servicio</h2>
                <p className="text-gray-500">Modifica los datos del servicio</p>
            </div>

            <div className="bg-white rounded-xl shadow p-6 max-w-2xl">
                <form onSubmit={handleSubmit}>

                    <div className="mb-4">
                        <label className="block text-sm font-medium text-gray-700 mb-1">
                            Nombre del servicio
                        </label>
                        <input
                            type="text"
                            value={data.name}
                            onChange={e => setData('name', e.target.value)}
                            className="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        />
                        {errors.name && <p className="text-red-500 text-xs mt-1">{errors.name}</p>}
                    </div>

                    <div className="mb-4">
                        <label className="block text-sm font-medium text-gray-700 mb-1">
                            Descripción
                        </label>
                        <textarea
                            value={data.description}
                            onChange={e => setData('description', e.target.value)}
                            rows="3"
                            className="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        />
                    </div>

                    <div className="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label className="block text-sm font-medium text-gray-700 mb-1">
                                Duración (minutos)
                            </label>
                            <input
                                type="number"
                                value={data.duration_minutes}
                                onChange={e => setData('duration_minutes', e.target.value)}
                                min="5"
                                max="480"
                                className="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            />
                            {errors.duration_minutes && <p className="text-red-500 text-xs mt-1">{errors.duration_minutes}</p>}
                        </div>
                        <div>
                            <label className="block text-sm font-medium text-gray-700 mb-1">
                                Precio
                            </label>
                            <input
                                type="number"
                                value={data.price}
                                onChange={e => setData('price', e.target.value)}
                                min="0"
                                step="100"
                                className="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            />
                            {errors.price && <p className="text-red-500 text-xs mt-1">{errors.price}</p>}
                        </div>
                    </div>

                    <div className="mb-6">
                        <label className="flex items-center gap-2 cursor-pointer">
                            <input
                                type="checkbox"
                                checked={data.is_active}
                                onChange={e => setData('is_active', e.target.checked)}
                                className="w-4 h-4 text-indigo-600"
                            />
                            <span className="text-sm font-medium text-gray-700">Servicio activo</span>
                        </label>
                    </div>

                    <div className="flex gap-3">
                        <button
                            type="submit"
                            disabled={processing}
                            className="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 font-medium disabled:opacity-50"
                        >
                            {processing ? 'Guardando...' : 'Guardar cambios'}
                        </button>
                        <Link
                            href="/business/services"
                            className="bg-gray-100 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-200 font-medium"
                        >
                            Cancelar
                        </Link>
                    </div>

                </form>
            </div>

        </BusinessLayout>
    );
}