import { PlaneLayout } from "@/layouts/planes/PlaneLayout";
import { PageProps } from "@inertiajs/core";
import { useTranslations } from "@/hooks/use-translations";
import { PlaneForm } from "./components/PlaneForm";

interface EditPlaneProps extends PageProps {
  plane: {
    id: string;
    code: string;
  };
  page?: string;
  perPage?: string;
  arrayPermissions?: string[];
}

export default function EditPlane({ plane, page, perPage, arrayPermissions }: EditPlaneProps) {
  const { t } = useTranslations();

  return (
    <PlaneLayout title={t("ui.planes.edit")}>
      <div className="p-6">
        <div className="max-w-xl">
          <PlaneForm
            initialData={plane}
            page={page}
            perPage={perPage}
            pageTitle={t("ui.planes.edit")}
          />
        </div>
      </div>
    </PlaneLayout>
  );
}
