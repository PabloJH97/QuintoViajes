import { Button } from '@/components/ui/button';
import { Card, CardContent, CardFooter, CardHeader, CardTitle } from '@/components/ui/card';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { useTranslations } from '@/hooks/use-translations';
import { router } from '@inertiajs/react';
import type { AnyFieldApi } from '@tanstack/react-form';
import { useForm } from '@tanstack/react-form';
import { useQueryClient } from '@tanstack/react-query';
import { FileText, Lock, Mail, PackageOpen, Save, Settings, Shield, SquareMenu, X, Eye, EyeOff } from 'lucide-react';
import { useState } from 'react';
import { Option, Select } from 'react-day-picker';
import { toast } from 'sonner';

interface PlaneFormProps {
    initialData?: {
        id: string;
        code: string;
        capacity: int;
    };
    page?: string;
    perPage?: string;
    pageTitle?: string;
}


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

export function PlaneForm({ initialData, page, perPage, pageTitle }: PlaneFormProps) {
    const { t } = useTranslations();
    const queryClient = useQueryClient();

    // TanStack Form setup
    const form = useForm({
        defaultValues: {
            code: initialData?.code ?? '',
            capacity: initialData?.capacity ?? '',
        },
        onSubmit: async ({ value }) => {
            const options = {
                onSuccess: () => {
                    queryClient.invalidateQueries({ queryKey: ['planes'] });

                    // Construct URL with page parameters
                    let url = '/planes';
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
                        toast.error(initialData ? t('messages.planes.error.update') : t('messages.planes.error.create'));
                    }
                },
            };

            // Submit with Inertia
            if (initialData) {
                router.put(`/planes/${initialData.id}`, value, options);
            } else {
                router.post('/planes', value, options);
            }
        },
    });

    // Form submission handler
    const handleSubmit = (e: React.FormEvent<HTMLFormElement>) => {
        e.preventDefault();
        e.stopPropagation();
        form.handleSubmit();
    };

    function PlaneFormData() {
        return (
            <CardContent className={'h-full bg-background'}>
                <div>
                    <form.Field
                        name="code"
                        validators={{
                            onChangeAsync: async ({ value }) => {
                                await new Promise((resolve) => setTimeout(resolve, 500));
                                return !value
                                    ? t('ui.validation.required', { attribute: t('ui.planes.fields.code').toLowerCase() })
                                    : value.length !=4
                                      ? t('ui.validation.size.string', { attribute: t('ui.planes.fields.code').toLowerCase(), size: '4' })
                                      : undefined;
                            },
                        }}
                    >
                        {(field) => (
                            <>
                                <div className="flex flex-row items-center">
                                    <SquareMenu className="w-5"></SquareMenu>
                                    <Label htmlFor={field.name}>{t('ui.planes.fields.code')}</Label>
                                </div>

                                <Input
                                    id={field.name}
                                    name={field.name}
                                    value={field.state.value}
                                    onChange={(e) => field.handleChange(e.target.value)}
                                    onBlur={field.handleBlur}
                                    placeholder={t('ui.planes.placeholders.code')}
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
                        name="capacity"
                        validators={{
                            onChangeAsync: async ({ value }) => {
                                await new Promise((resolve) => setTimeout(resolve, 500));
                                return !value
                                    ? t('ui.validation.required', { attribute: t('ui.planes.fields.capacity').toLowerCase() })
                                    : value < 1 || value > 250
                                      ? t('ui.validation.between.numeric', { attribute: t('ui.planes.fields.capacity').toLowerCase(), min: '1', max: '250' })
                                      : undefined;
                            },
                        }}
                    >
                        {(field) => (
                            <>
                                <div className="flex flex-row items-center">
                                    <SquareMenu className="w-5"></SquareMenu>
                                    <Label htmlFor={field.name}>{t('ui.planes.fields.capacity')}</Label>
                                </div>

                                <Input
                                    id={field.name}
                                    name={field.name}
                                    type='number'
                                    value={field.state.value}
                                    onChange={(e) => field.handleChange(e.target.value)}
                                    onBlur={field.handleBlur}
                                    placeholder={t('ui.planes.placeholders.capacity')}
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



    function PlaneFormView() {
        return (
            <form onSubmit={handleSubmit} className="space-y-4" noValidate>
                {/* Name field */}
                <Card className="bg-background">
                    <CardHeader>
                        <div className="flex flex-row">
                            <SquareMenu color="#155dfc"></SquareMenu>
                            <h1 className="font-bold">{pageTitle}</h1>
                        </div>

                    </CardHeader>

                    <div><PlaneFormData></PlaneFormData></div>

                    {/* Form buttons */}
                    <CardFooter className="justify-center">
                        <div className="flex w-full flex-row justify-between gap-4">
                            <Button
                                type="button"
                                variant="outline"
                                onClick={() => {
                                    let url = '/planes';
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
                                {t('ui.planes.buttons.cancel')}
                            </Button>

                            <form.Subscribe selector={(state) => [state.canSubmit, state.isSubmitting]}>
                                {([canSubmit, isSubmitting]) => (
                                    <Button type="submit" disabled={!canSubmit} className="bg-blue-400">
                                        <Save></Save>
                                        {isSubmitting
                                            ? t('ui.planes.buttons.saving')
                                            : initialData
                                              ? t('ui.planes.buttons.update')
                                              : t('ui.planes.buttons.save')}
                                    </Button>
                                )}
                            </form.Subscribe>
                        </div>
                    </CardFooter>
                </Card>
            </form>
        );
    }

    return <PlaneFormView></PlaneFormView>;
}
