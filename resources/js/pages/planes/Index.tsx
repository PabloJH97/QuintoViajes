import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { TableSkeleton } from "@/components/stack-table/TableSkeleton";
import { UserLayout } from "@/layouts/users/UserLayout";
import { User, useDeleteUser, useUsers } from "@/hooks/users/useUsers";
import { PencilIcon, PlusIcon, TrashIcon } from "lucide-react";
import { useDebounce } from "@/hooks/use-debounce";
import { useState, useMemo } from "react";
import { Link, usePage } from "@inertiajs/react";
import { useTranslations } from "@/hooks/use-translations";
import { Table } from "@/components/stack-table/Table";
import { createTextColumn, createDateColumn, createActionsColumn } from "@/components/stack-table/columnsTable";
import { DeleteDialog } from "@/components/stack-table/DeleteDialog";
import { FiltersTable, FilterConfig } from "@/components/stack-table/FiltersTable";
import { toast } from "sonner";
import { ColumnDef, Row } from "@tanstack/react-table";
import { PlaneLayout } from "@/layouts/planes/PlaneLayout";
import { Plane, useDeletePlane, usePlanes } from "@/hooks/planes/usePlanes";
import { isEmpty } from "lodash";


export default function PlanesIndex() {
  const { t } = useTranslations();
  const { url } = usePage();


  // Obtener los parámetros de la URL actual
  const urlParams = new URLSearchParams(url.split('?')[1] || '');
  const pageParam = urlParams.get('page');
  const perPageParam = urlParams.get('per_page');

  // Inicializar el estado con los valores de la URL o los valores predeterminados
  const [currentPage, setCurrentPage] = useState(pageParam ? parseInt(pageParam) : 1);
  const [perPage, setPerPage] = useState(perPageParam ? parseInt(perPageParam) : 10);
  const [filters, setFilters] = useState<Record<string, any>>({});
  // Combine name and email filters into a single search string if they exist
  const combinedSearch = [
    filters.code ? filters.code : 'null',
    filters.capacity ? filters.capacity : 'null',
    filters.created_at ? filters.created_at : 'null',
  ];

  const { data: planes, isLoading, isError, refetch } = usePlanes({
    search: combinedSearch,
    page: currentPage,
    perPage: perPage,
  });
  const deletePlaneMutation = useDeletePlane();
  const [filterState, setFilterState]=useState(false);

  const handlePageChange = (page: number) => {
    setCurrentPage(page);
  };

  const handlePerPageChange = (newPerPage: number) => {
    setPerPage(newPerPage);
    setCurrentPage(1); // Reset to first page when changing items per page
  };
  const handleFilterChange = (newFilters: Record<string, any>) => {
    const filtersChanged = newFilters!==filters;

    if (filtersChanged) {
        setCurrentPage(1);
    }
    isEmpty(filters) ? setFilterState(false) : setFilterState(true)
    setFilters(newFilters);
    };

  const handleDeletePlane = async (id: string) => {
    try {
      await deletePlaneMutation.mutateAsync(id);
      refetch();
    } catch (error) {
      toast.error(t("ui.planes.deleted_error") || "Error deleting plane");
      console.error("Error deleting plane:", error);
    }
  };

  const columns = useMemo(() => ([
    createTextColumn<Plane>({
      id: "code",
      header: t("ui.planes.columns.code") || "Code",
      accessorKey: "code",
    }),
    createTextColumn<Plane>({
      id: "capacity",
      header: t("ui.planes.columns.capacity") || "Capacity",
      accessorKey: "capacity",
    }),
    createDateColumn<Plane>({
      id: "created_at",
      header: t("ui.planes.columns.created_at") || "Created At",
      accessorKey: "created_at",
    }),
    createActionsColumn<Plane>({
      id: "actions",
      header: t("ui.planes.columns.actions") || "Actions",
      renderActions: (plane) => (
        <>
          <Link href={`/planes/${plane.id}/edit?page=${currentPage}&perPage=${perPage}`}>
            <Button variant="outline" size="icon" title={t("ui.planes.buttons.edit") || "Edit plane"}>
              <PencilIcon className="h-4 w-4" />
            </Button>
          </Link>
          <DeleteDialog
            id={plane.id}
            onDelete={handleDeletePlane}
            title={t("ui.planes.delete.title") || "Delete plane"}
            description={t("ui.planes.delete.description") || "Are you sure you want to delete this plane? This action cannot be undone."}
            trigger={
              <Button variant="outline" size="icon" className="text-destructive hover:text-destructive" title={t("ui.planes.buttons.delete") || "Delete plane"}>
                <TrashIcon className="h-4 w-4" />
              </Button>
            }
          />
        </>
      ),
    }),
  ] as ColumnDef<Plane>[]), [t, handleDeletePlane]);

  return (
      <PlaneLayout title={t('ui.planes.title')}>
          <div className="p-6">
              <div className="space-y-6">
                  <div className="flex items-center justify-between">
                      <h1 className="text-3xl font-bold">{t('ui.planes.title')}</h1>
                      <Link href="/planes/create">
                          <Button>
                              <PlusIcon className="mr-2 h-4 w-4" />
                              {t('ui.planes.buttons.new')}
                          </Button>
                      </Link>
                  </div>
                  <div></div>

                  <div className="space-y-4">
                      <FiltersTable
                          filters={
                              [
                                  {
                                      id: 'code',
                                      label: t('ui.planes.filters.code') || 'Code',
                                      type: 'text',
                                      placeholder: t('ui.planes.placeholders.code') || 'Code...',
                                  },
                                  {
                                      id: 'capacity',
                                      label: t('ui.planes.filters.capacity') || 'Capacity',
                                      type: 'number',
                                      placeholder: t('ui.planes.placeholders.name') || 'Capacity...',
                                  },
                                  {
                                      id: 'created_at',
                                      label: t('ui.planes.filters.created_at') || 'Created at',
                                      type: 'date',
                                      placeholder: t('ui.planes.placeholders.created_at') || 'Created at...',
                                  },

                              ] as FilterConfig[]
                          }
                          onFilterChange={handleFilterChange}
                          initialValues={filters}
                      />
                  </div>
                  {filterState && planes?.meta.total!=undefined && <h2>{t('ui.common.filters.results')+planes?.meta.total}</h2>}
                  <div className="w-full overflow-hidden">
                      {isLoading ? (
                          <TableSkeleton columns={4} rows={10} />
                      ) : isError ? (
                          <div className="p-4 text-center">
                              <div className="mb-4 text-red-500">{t('ui.planes.error_loading')}</div>
                              <Button onClick={() => refetch()} variant="outline">
                                  {t('ui.planes.buttons.retry')}
                              </Button>
                          </div>
                      ) : (
                          <div>
                              <Table
                                  data={
                                      planes ?? {
                                          data: [],
                                          meta: {
                                              current_page: 1,
                                              from: 0,
                                              last_page: 1,
                                              per_page: perPage,
                                              to: 0,
                                              total: 0,
                                          },
                                      }
                                  }
                                  columns={columns}
                                  onPageChange={handlePageChange}
                                  onPerPageChange={handlePerPageChange}
                                  perPageOptions={[10, 25, 50, 100]}
                                  noResultsMessage={t('ui.planes.no_results') || 'No planes found'}
                              />
                          </div>
                      )}
                  </div>
              </div>
          </div>
      </PlaneLayout>
  );
}
