import { Button } from '@/components/ui/button';
import { Card, CardContent, CardFooter, CardHeader } from '@/components/ui/card';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { useTranslations } from '@/hooks/use-translations';
import { router } from '@inertiajs/react';
import type { AnyFieldApi } from '@tanstack/react-form';
import { useForm } from '@tanstack/react-form';
import { useQueryClient } from '@tanstack/react-query';
import { Save, SquareMenu, X } from 'lucide-react';
import { useState } from 'react';
import { toast } from 'sonner';

interface FlightFormProps {
    initialData?: {
        id: string;
        code: string;
        origin: string;
        destination: string;
        price: float;
        seats: string[];
        date: string;
    };
    page?: string;
    perPage?: string;
    pageTitle?: string;
    planeCode: string;
}

let seatArray: string[];
seatArray = [];
// Field error display component
function FieldInfo({ field }: { field: AnyFieldApi }) {
    return (
        <>
            {field.state.meta.isTouched && field.state.meta.errors.length ? (
                <p className="text-destructive mt-1 text-sm">{field.state.meta.errors.join(', ')}</p>
            ) : null}
            {field.state.meta.isValidating ? <p className="text-muted-foreground mt-1 text-sm">Validating...</p> : null}
        </>
    );
}

export function FlightForm({ initialData, page, perPage, pageTitle, planeCode }: FlightFormProps) {
    const { t } = useTranslations();
    const queryClient = useQueryClient();
    const [seatsArray, setSeatsArray] = useState(initialData?.seats ?? seatArray);

    function putInSeatsArray(value: string) {
        if (!seatsArray.includes(value)) {
            seatArray = [...seatArray, value];
            setSeatsArray(seatArray);
        } else {
            seatArray = seatArray.filter((a) => a !== value);
            setSeatsArray(seatArray);
        }
        form.setFieldValue('seats', seatArray.toString());
    }

    // TanStack Form setup
    const form = useForm({
        defaultValues: {
            code: initialData?.code ?? '',
            origin: initialData?.origin ?? '',
            destination: initialData?.destination ?? '',
            price: initialData?.price ?? '',
            seats: initialData?.seats ?? '',
            date: initialData?.date ?? '',
            planeCode: planeCode ?? '',
        },
        onSubmit: async ({ value }) => {
            const options = {
                onSuccess: () => {
                    queryClient.invalidateQueries({ queryKey: ['flights'] });

                    // Construct URL with page parameters
                    let url = '/flights';
                    if (page) {
                        url += `?page=${page}`;
                        if (perPage) {
                            url += `&per_page=${perPage}`;
                        }
                    }

                    router.visit(url);
                },
                onError: (errors: Record<string, string>) => {
                    if (Object.keys(errors).length === 0) {
                        toast.error(initialData ? t('messages.flights.error.update') : t('messages.flights.error.create'));
                    }
                },
            };

            // Submit with Inertia
            if (initialData) {
                router.put(`/flights/${initialData.id}`, value, options);
            } else {
                router.post('/flights', value, options);
            }
        },
    });

    // Form submission handler
    const handleSubmit = (e: React.FormEvent<HTMLFormElement>) => {
        e.preventDefault();
        e.stopPropagation();
        form.handleSubmit();
    };

    function FlightFormData() {
        return (
            <CardContent className={'bg-background h-full'}>
                <div>
                    <form.Field
                        name="code"
                        validators={{
                            onChangeAsync: async ({ value }) => {
                                await new Promise((resolve) => setTimeout(resolve, 500));
                                return !value
                                    ? t('ui.validation.required', { attribute: t('ui.flights.fields.code').toLowerCase() })
                                    : value.length != 4
                                      ? t('ui.validation.size.string', { attribute: t('ui.flights.fields.code').toLowerCase(), size: '4' })
                                      : undefined;
                            },
                        }}
                    >
                        {(field) => (
                            <>
                                <div className="flex flex-row items-center">
                                    <SquareMenu className="w-5"></SquareMenu>
                                    <Label htmlFor={field.name}>{t('ui.flights.fields.code')}</Label>
                                </div>

                                <Input
                                    id={field.name}
                                    name={field.name}
                                    value={field.state.value}
                                    onChange={(e) => field.handleChange(e.target.value)}
                                    onBlur={field.handleBlur}
                                    placeholder={t('ui.flights.placeholders.code')}
                                    disabled={form.state.isSubmitting}
                                    required={false}
                                    autoComplete="off"
                                />
                                <FieldInfo field={field} />
                            </>
                        )}
                    </form.Field>
                </div>
                <br />
                <div>
                    <form.Field
                        name="planeCode"
                        validators={{
                            onChangeAsync: async ({ value }) => {
                                await new Promise((resolve) => setTimeout(resolve, 500));
                                return !value
                                    ? t('ui.validation.required', { attribute: t('ui.flights.fields.plane').toLowerCase() })
                                    : value.length != 4
                                      ? t('ui.validation.size.string', { attribute: t('ui.flights.fields.plane').toLowerCase(), size: '4' })
                                      : undefined;
                            },
                        }}
                    >
                        {(field) => (
                            <>
                                <div className="flex flex-row items-center">
                                    <SquareMenu className="w-5"></SquareMenu>
                                    <Label htmlFor={field.name}>{t('ui.flights.fields.plane')}</Label>
                                </div>

                                <Input
                                    id={field.name}
                                    name={field.name}
                                    value={field.state.value}
                                    onChange={(e) => field.handleChange(e.target.value)}
                                    onBlur={field.handleBlur}
                                    placeholder={t('ui.flights.placeholders.plane')}
                                    disabled={form.state.isSubmitting}
                                    required={false}
                                    autoComplete="off"
                                />
                                <FieldInfo field={field} />
                            </>
                        )}
                    </form.Field>
                </div>
                <br />
                <div>
                    <form.Field
                        name="origin"
                        validators={{
                            onChangeAsync: async ({ value }) => {
                                await new Promise((resolve) => setTimeout(resolve, 500));
                                return !value
                                    ? t('ui.validation.required', { attribute: t('ui.flights.fields.origin').toLowerCase() })
                                    : value.length <= 1
                                      ? t('ui.validation.gt.string', { attribute: t('ui.flights.fields.origin').toLowerCase(), value: '1' })
                                      : undefined;
                            },
                        }}
                    >
                        {(field) => (
                            <>
                                <div className="flex flex-row items-center">
                                    <SquareMenu className="w-5"></SquareMenu>
                                    <Label htmlFor={field.name}>{t('ui.flights.fields.origin')}</Label>
                                </div>

                                <Input
                                    id={field.name}
                                    name={field.name}
                                    value={field.state.value}
                                    onChange={(e) => field.handleChange(e.target.value)}
                                    onBlur={field.handleBlur}
                                    placeholder={t('ui.flights.placeholders.origin')}
                                    disabled={form.state.isSubmitting}
                                    required={false}
                                    autoComplete="off"
                                />
                                <FieldInfo field={field} />
                            </>
                        )}
                    </form.Field>
                </div>
                <br />
                <div>
                    <form.Field
                        name="destination"
                        validators={{
                            onChangeAsync: async ({ value }) => {
                                await new Promise((resolve) => setTimeout(resolve, 500));
                                return !value
                                    ? t('ui.validation.required', { attribute: t('ui.flights.fields.destination').toLowerCase() })
                                    : value.length <= 1
                                      ? t('ui.validation.gt.string', { attribute: t('ui.flights.fields.destination').toLowerCase(), value: '1' })
                                      : undefined;
                            },
                        }}
                    >
                        {(field) => (
                            <>
                                <div className="flex flex-row items-center">
                                    <SquareMenu className="w-5"></SquareMenu>
                                    <Label htmlFor={field.name}>{t('ui.flights.fields.destination')}</Label>
                                </div>

                                <Input
                                    id={field.name}
                                    name={field.name}
                                    value={field.state.value}
                                    onChange={(e) => field.handleChange(e.target.value)}
                                    onBlur={field.handleBlur}
                                    placeholder={t('ui.flights.placeholders.destination')}
                                    disabled={form.state.isSubmitting}
                                    required={false}
                                    autoComplete="off"
                                />
                                <FieldInfo field={field} />
                            </>
                        )}
                    </form.Field>
                </div>
                <br />
                <div>
                    <form.Field
                        name="price"
                        validators={{
                            onChangeAsync: async ({ value }) => {
                                await new Promise((resolve) => setTimeout(resolve, 500));
                                return !value
                                    ? t('ui.validation.required', { attribute: t('ui.flights.fields.price').toLowerCase() })
                                    : value <= 1
                                      ? t('ui.validation.gt.numeric', { attribute: t('ui.flights.fields.price').toLowerCase(), value: '1' })
                                      : undefined;
                            },
                        }}
                    >
                        {(field) => (
                            <>
                                <div className="flex flex-row items-center">
                                    <SquareMenu className="w-5"></SquareMenu>
                                    <Label htmlFor={field.name}>{t('ui.flights.fields.price')}</Label>
                                </div>

                                <Input
                                    id={field.name}
                                    name={field.name}
                                    value={field.state.value}
                                    type="number"
                                    onChange={(e) => field.handleChange(e.target.value)}
                                    onBlur={field.handleBlur}
                                    placeholder={t('ui.flights.placeholders.price')}
                                    disabled={form.state.isSubmitting}
                                    required={false}
                                    autoComplete="off"
                                />
                                <FieldInfo field={field} />
                            </>
                        )}
                    </form.Field>
                </div>
                <br />
                <div>
                    <form.Field
                        name="seats"
                    >
                        {(field) => (
                            <>
                                <div className="flex flex-row items-center">
                                    <SquareMenu className="w-5"></SquareMenu>
                                    <Label htmlFor={field.name}>{t('ui.flights.fields.seats.name')}</Label>
                                </div>
                                <div className="flex flex-row">
                                    <div className="flex flex-row p-2">
                                        <Checkbox
                                            id={'1st'}
                                            name={'1st'}
                                            className="border-blue-600"
                                            value={'1st'}
                                            checked={seatsArray.includes('1st')}
                                            onCheckedChange={() => putInSeatsArray('1st')}
                                        ></Checkbox>
                                        <Label>{t('ui.flights.fields.seats.1st')}</Label>
                                    </div>
                                    <div className="flex flex-row p-2">
                                        <Checkbox
                                            id={'2nd'}
                                            name={'2nd'}
                                            className="border-blue-600"
                                            value={'2nd'}
                                            checked={seatsArray.includes('2nd')}
                                            onCheckedChange={() => putInSeatsArray('2nd')}
                                        ></Checkbox>
                                        <Label>{t('ui.flights.fields.seats.2nd')}</Label>
                                    </div>
                                    <div className="flex flex-row p-2">
                                        <Checkbox
                                            id={'tourist'}
                                            name={'tourist'}
                                            className="border-blue-600"
                                            value={'tourist'}
                                            checked={seatsArray.includes('tourist')}
                                            onCheckedChange={() => putInSeatsArray('tourist')}
                                        ></Checkbox>
                                        <Label>{t('ui.flights.fields.seats.tourist')}</Label>
                                    </div>
                                </div>

                                <FieldInfo field={field} />
                            </>
                        )}
                    </form.Field>
                </div>

                <div>
                    <form.Field
                        name="date"
                        validators={{
                            onChangeAsync: async ({ value }) => {
                                await new Promise((resolve) => setTimeout(resolve, 500));
                                return !value
                                    ? t('ui.validation.required', { attribute: t('ui.flights.fields.date').toLowerCase() })
                                    : value == null
                                      ? t('ui.validation.date', { attribute: t('ui.flights.fields.date').toLowerCase() })
                                      : undefined;
                            },
                        }}
                    >
                        {(field) => (
                            <>
                                <div className="flex flex-row items-center">
                                    <SquareMenu className="w-5"></SquareMenu>
                                    <Label htmlFor={field.name}>{t('ui.flights.fields.date')}</Label>
                                </div>

                                <Input
                                    id={field.name}
                                    name={field.name}
                                    value={field.state.value}
                                    type="date"
                                    onChange={(e) => field.handleChange(e.target.value)}
                                    onBlur={field.handleBlur}
                                    placeholder={t('ui.flights.placeholders.date')}
                                    disabled={form.state.isSubmitting}
                                    required={false}
                                    autoComplete="off"
                                />
                                <FieldInfo field={field} />
                            </>
                        )}
                    </form.Field>
                </div>
                <br />
            </CardContent>
        );
    }

    function FlightFormView() {
        return (
            <form onSubmit={handleSubmit} className="space-y-4" noValidate>
                {/* Name field */}
                <Card className="bg-background">
                    <CardHeader>
                        <div className="flex flex-row">
                            <SquareMenu color="#155dfc"></SquareMenu>
                            <h1 className="font-bold">{pageTitle}</h1>
                        </div>
                        <div>
                            <p className="font-sans text-sm font-bold text-gray-400">
                                {'Ingresa la información para crear un nuevo piso en el sistema'}
                            </p>
                        </div>
                    </CardHeader>

                    <div>
                        <FlightFormData></FlightFormData>
                    </div>

                    {/* Form buttons */}
                    <CardFooter className="justify-center">
                        <div className="flex w-full flex-row justify-between gap-4">
                            <Button
                                type="button"
                                variant="outline"
                                onClick={() => {
                                    let url = '/flights';
                                    if (page) {
                                        url += `?page=${page}`;
                                        if (perPage) {
                                            url += `&per_page=${perPage}`;
                                        }
                                    }
                                    router.visit(url);
                                }}
                                disabled={form.state.isSubmitting}
                            >
                                <X></X>
                                {t('ui.flights.buttons.cancel')}
                            </Button>

                            <form.Subscribe selector={(state) => [state.canSubmit, state.isSubmitting]}>
                                {([canSubmit, isSubmitting]) => (
                                    <Button type="submit" disabled={!canSubmit} className="bg-blue-400">
                                        <Save></Save>
                                        {isSubmitting
                                            ? t('ui.flights.buttons.saving')
                                            : initialData
                                              ? t('ui.flights.buttons.update')
                                              : t('ui.flights.buttons.save')}
                                    </Button>
                                )}
                            </form.Subscribe>
                        </div>
                    </CardFooter>
                </Card>
            </form>
        );
    }

    return <FlightFormView></FlightFormView>;
}
